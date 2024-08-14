<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AlumniprofileController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view profile', only: ['index', 'show']),
            new Middleware('permission:create profile', only: ['create', 'store']),
            new Middleware('permission:edit profile', only: ['edit', 'update']),
            new Middleware('permission:delete profile', only: ['destroy']),
        ];
    }

    public function index()
    {
        if (Auth::user()->hasRole('super-admin')) {
            // Super admin can view all profiles
            $profiles = Profile::all();
            return view('profiles.index', compact('profiles'));
        } elseif (Auth::user()->hasRole('alumni') || Auth::user()->hasRole('admin')) {
            // Alumni or admin can view only their own profile
            $profiles = Profile::where('user_id', Auth::user()->id)->get();
            return view('profiles.canview', compact('profiles'));
        } else {
            // If the user does not have permission, show an unauthorized error
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'workspace' => 'required|string|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'skills' => 'nullable|string|max:1000',
            'current_occupation' => 'nullable|string|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['user_id'] = Auth::user()->id;

        Profile::create($data);

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:profiles,email,' . $profile->id,
            'phone_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'education' => 'nullable|string',
            'workspace' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($profile->image) {
                Storage::disk('public')->delete($profile->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $profile->update($data);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(Profile $profile)
    {
        if ($profile->image) {
            Storage::disk('public')->delete($profile->image);
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
