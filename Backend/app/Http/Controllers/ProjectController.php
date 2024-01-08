<?php

namespace App\Http\Controllers;
use App\Exceptions\ProjectNotFoundException;


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
   
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate',
        ]);
        $validatedData['status'] = 'active';
        $project = Project::create($validatedData);
        return response()->json($project, 201);
    }

    public function editById($id, Request $request)
    {
        $validatedData = $request->validate([
            'StartDate' => 'date',
            'EndDate' => 'date|after:StartDate',
        ]);
        $project = Project::findOrFail($id);
        $project->update($validatedData);
        return response()->json($project, 200);
    }

    public function getById($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project, 200);
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
