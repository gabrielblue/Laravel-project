<?php


namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ApplicationApproved;
use App\Notifications\ApplicationDenied;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class JobController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view job', only: ['index', 'show']),
            new Middleware('permission:create job', only: ['create', 'store']),
            new Middleware('permission:edit job', only: ['update', 'edit']),
            new Middleware('permission:delete job', only: ['destroy']),
        ];
    }

    public function index()
    {
        $jobs = Job::with('skills')->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $skills = Skill::all();
        return view('jobs.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->qualifications = $request->qualifications;
        $job->location = $request->location;
        $job->views = 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $job->image = $path;
        }

        $job->save();
        $job->skills()->sync($request->skills);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        $job->load('skills');
        $job->increment('views');
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $skills = Skill::all();
        return view('jobs.edit', compact('job', 'skills'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $job->title = $request->title;
        $job->description = $request->description;
        $job->qualifications = $request->qualifications;
        $job->location = $request->location;

        if ($request->hasFile('image')) {
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $job->image = $path;
        }

        $job->save();
        $job->skills()->sync($request->skills);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        $job->skills()->detach();
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function apply(Job $job)
    {
        $job->load('skills');
        return view('jobs.apply', compact('job'));
    }

    public function applyStore(Request $request, Job $job)
    {
        \Log::info('Job ID:', ['job_id' => $job->id]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        $application = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);

        $application->skills()->sync($request->skills);

        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
    }

    public function applications()
    {
        $applications = JobApplication::with('job')->get();
        return view('jobs.applications', compact('applications'));
    }

    public function apiShow(Job $job)
    {
        $job->load('skills');
        $job->skills->makeHidden('pivot');
        return response()->json($job);
    }

    public function review($applicationId)
    {
        $application = JobApplication::findOrFail($applicationId);
        $application->status = 'reviewed';
        $application->save();
    
        return redirect('/applications')->with('status', 'Application reviewed and email sent.');
    }
    
    public function approve($applicationId)
    {
        $application = JobApplication::findOrFail($applicationId);

        $application->status = 'approved';
        $application->save();

        if ($application->user) {
            $application->user->notify(new ApplicationApproved($application));
        } else {
            return redirect('/applications')->with('error', 'User not found for this application.');
        }

        return redirect('/applications')->with('status', 'Application approved and user notified.');
    }

    public function deny($applicationId)
    {
        $application = JobApplication::findOrFail($applicationId);

        $application->status = 'denied';
        $application->save();

        if ($application->user) {
            $application->user->notify(new ApplicationDenied($application));
        } else {
            return redirect('/applications')->with('error', 'User not found for this application.');
        }

        return redirect('/applications')->with('status', 'Application denied and user notified.');
    }
}
