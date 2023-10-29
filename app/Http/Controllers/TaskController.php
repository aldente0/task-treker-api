<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(string $project_id)
    {
        try {
            $project = Project::findOrFail($project_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        $tasks = $project->tasks;

        return response()->json($tasks);
    }

    public function store(Request $request, string $project_id)
    {
        try {
            $project = Project::findOrFail($project_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        $validator = Validator::make($request->all(), [
            'status_id' => 'integer|required|exists:task_statuses,id',
            'type_id' => 'required|integer|exists:task_types,id',
            'title' => 'required|string|min:2|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task = new Task($request->all());
        $task->project()->associate($project);
        $task->save();

        return response()->json($task, 201);
    }

    public function update(Request $request, string $task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
        } catch (Exception $e) {
            return  response()->json(['message' => $e->getMessage()], 400);
        }

        $validator = Validator::make($request->all(), [
            'status_id' => 'sometimes|integer|exists:task_statuses,id',
            'type_id' => 'sometimes|integer|exists:task_types,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task->update($request->all());

        return response()->json($task);
    }

    public function destroy(string $task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
        } catch (Exception $e) {
            return  response(['message' => $e->getMessage()], 404);
        }

        if ($task->delete()) {
            return response()->json(['message' => 'Task deleted successfully'], 200);
        }
    }
}
