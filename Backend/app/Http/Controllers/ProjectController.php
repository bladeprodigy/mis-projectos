<?php

namespace App\Http\Controllers;


use App\Models\Project; 
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   
    public function create(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function editById($id, Request $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function getById($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project, 200);
    }

    public function getAll()
    {
        $projects = Project::all();
        return response()->json($projects, 200);
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
