<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    // Apply middleware in the constructor
    public function __construct()
    {
        $this->middleware('permission:view project')->only(['index', 'show']);
        $this->middleware('permission:create project')->only(['create', 'store']);
        $this->middleware('permission:edit project')->only(['edit', 'update']);
        $this->middleware('permission:delete project')->only(['destroy']);
    }

    // Show a list of projects
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Show form to create a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store a new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric',
            'source_code_url' => 'nullable|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('projects', 'public') : null;

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'price' => $request->price,
            'source_code_url' => $request->source_code_url,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Show form to edit a project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Update an existing project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric',
            'source_code_url' => 'nullable|url',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('projects', 'public') : $project->image;

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'price' => $request->price,
            'source_code_url' => $request->source_code_url,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Delete a project
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    // Show project details
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
