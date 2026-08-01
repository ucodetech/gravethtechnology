<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Traits\UploadsImages;

class ProjectController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->uploadToCloudinary($request->file('image'), 'projects');
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Image upload failed: ' . $e->getMessage()], 500);
            }
        }

        Project::create($data);

        return response()->json(['success' => true, 'message' => 'Project added successfully!']);
    }

    public function edit(Project $project)
    {
        return response()->json($project);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->uploadToCloudinary($request->file('image'), 'projects');
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Image upload failed: ' . $e->getMessage()], 500);
            }
        }

        $project->update($data);

        return response()->json(['success' => true, 'message' => 'Project updated successfully!']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['success' => true, 'message' => 'Project deleted successfully!']);
    }
}
