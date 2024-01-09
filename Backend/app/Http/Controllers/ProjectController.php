<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Exceptions\ProjectNotFoundException;
use App\Models\User;
use App\Models\Project; 
=======

use App\Models\Project;
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
use Illuminate\Http\Request;

class ProjectController extends Controller
{
<<<<<<< HEAD
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            throw new ProjectNotFoundException($id);
        }

        return view('projects.show', ['project' => $project]);
    }
   
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate',
        ]);
        $validatedData['status'] = 'ongoing';
        $project = Project::create($validatedData);
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
=======
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
}
