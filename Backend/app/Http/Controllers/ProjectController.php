<?php

namespace App\Http\Controllers;
use App\Exceptions\ProjectNotFoundException;
use App\Models\User;
use App\Models\Project; 
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            throw new ProjectNotFoundException($id);
        }

        return view('projects.show', ['project' => $project]);
    }
   
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ]);

    $project = new Project($validatedData);
    $project->user_id = auth()->user()->id;
    $project->status = 'ongoing';
    $project->save(); // This will generate a project_id

    // Attach the currently authenticated user to the project
    $project->users()->attach(auth()->user()->id);

    return response()->json($project, 201);
}

    public function editById($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $project = Project::findOrFail($id);
        $project->update($validatedData);
    
        return response()->json($project, 200);
    }

    public function addUserToProject(Request $request, $projectId)
    {
        $user = User::findOrFail($request->userId);
        $project = Project::findOrFail($projectId);
    
        if (auth()->user()->id !== $project->user_id) {
            return response()->json(['error' => 'You can only add users to your own projects.'], 403);
        }
    
        $project->users()->attach($user->id);
    
        return response()->json(['message' => 'User added to project successfully'], 200);
    }

    public function removeUserFromProject($projectId, $userId)
    {
        $project = Project::findOrFail($projectId);

        if (auth()->user()->id === $project->user_id && auth()->user()->id === $userId) {
            return response()->json(['error' => 'You cannot remove yourself from your own project.'], 403);
        }
    
        if (auth()->user()->id !== $project->user_id && auth()->user()->id !== $userId) {
            return response()->json(['error' => 'You can only remove yourself or users from your own projects.'], 403);
        }
    
        $project->users()->detach($userId);
    
        return response()->json(null, 204);
    }

    public function getById($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project, 200);
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);

        if (auth()->user()->id !== $project->user_id) {
            return response()->json(['error' => 'You can only delete your own projects.'], 403);
        }
    
        $project->delete();
    
        return response()->json(null, 204);
    }
    
    public function finish($id)
    {
    $project = Project::findOrFail($id);
    if ($project->status == 'ongoing') {
        $project->status = 'finished';
        $project->save();
        return response()->json($project, 200);
    } else {
        return response()->json(['error' => 'Project is not ongoing'], 400);
    }
    }

    public function getOngoing(Request $request)
    {
    $user = $request->user();
    $projects = $user->projects()->where('status', 'ongoing')->get();
    return response()->json($projects, 200);
    }

    public function getFinished(Request $request)
    {
    $user = $request->user();
    $projects = $user->projects()->where('status', 'finished')->get();
    return response()->json($projects, 200);
    }

    public function getUsers($projectId)
    {
    $project = Project::findOrFail($projectId);
    $users = $project->users;

    return response()->json($users, 200);
    }
}
