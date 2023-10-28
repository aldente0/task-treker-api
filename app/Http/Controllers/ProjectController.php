<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all(['id', 'name', 'created_at']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|string',
        ]);

        $project = new Project;
        $project->name = $request->input('name');
        $project->save();

        return $project;
    }
}
