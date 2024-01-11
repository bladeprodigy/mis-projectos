<?php

namespace App\Http\Controllers;
use App\Exceptions\ProjectNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Project; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'plannedEndDate' => 'required|date',
        ]);
    
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->plannedEndDate = $request->plannedEndDate;
        $project->owner_id = Auth::id();
        $project->participants = $request->participants;
        $project->save();
    
        return response()->json($project, 201);
    }


    public function show($id)
    {
        try {
            $project = Project::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProjectNotFoundException('Project not found.');
        }
    
        if ($project->owner_id !== Auth::id()) {
            return response()->json(['error' => 'You can only view your own projects.'], 403);
        }
    
        return response()->json($project, 200);
    }

    public function getOngoingProjects()
    {
    $projects = Project::where('status', 'ongoing')
        ->where('owner_id', Auth::id())
        ->get();

    return response()->json($projects, 200);
    }

    public function getCompletedProjects()
    {
    $projects = Project::where('status', 'completed')
        ->where('owner_id', Auth::id())
        ->get();

    return response()->json($projects, 200);
    }


    public function update(Request $request, Project $project)
{
    if ($project->owner_id !== Auth::id()) {
        return response()->json(['error' => 'You can only edit your own projects.'], 403);
    }
    if ($project->status === 'completed') {
        return response()->json(['error' => 'You cannot edit a completed project.'], 403);
    }

    $validatedData = $request->validate([
        'name' => 'nullable|string|min:1|max:255',
        'description' => 'sometimes|required',
        'endDate' => 'sometimes|required|date',
        'participants' => 'sometimes|nullable|string',
    ]);

    if (array_key_exists('name', $validatedData) && $validatedData['name'] === null) {
        return response()->json(['error' => 'Failed to update. Check your input.'], 422);
    }

    $project->fill($validatedData);
    if (!$project->save()) {
        return response()->json(['error' => 'Failed to update. Check your input.'], 500);
    }

    return response()->json($project, 200);
}


    public function destroy(Project $project)
    {
    if ($project->owner_id !== Auth::id()) {
         return response()->json(['error' => 'You can only delete your own projects.'], 403);
    }

    if ($project->status !== 'ongoing') {
        return response()->json(['error' => 'You can only delete ongoing projects.'], 403);
    }

    $project->delete();

    return response()->json(['message' => 'Project deleted successfully.'], 200);
    }


    public function complete(Project $project)
    {
        if ($project->owner_id !== Auth::user()->id) {
            return response()->json(['error' => 'You can only complete your own projects.'], 403);
        }
        if ($project->status !== 'ongoing') {
            return response()->json(['error' => 'You can only complete ongoing projects.'], 403);
        }
    

    
        $project->status = 'completed';
        $project->save();
    
        return response()->json($project, 200);
    }

}