<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(string $project_id)
    {
        try {
            Project::findOrFail($project_id);
        } catch (ModelNotFoundException $e) {
            return response(['status' => 'error', 'message' => 'Invalid query. Check project_id.'], 404);
        }

        $tasks = DB::table('tasks')
            ->join('projects', 'project_id', '=', 'projects.id')
            ->join('task_statuses', 'status_id', '=', 'task_statuses.id')
            ->join('task_types', 'type_id', '=', 'task_types.id')
            ->select('tasks.id', 'projects.name as project', 'task_statuses.name as status', 'task_types.name as type', 'title', 'description')
            ->where('projects.id', '=', $project_id)
            ->get();

        return response(['status' => 'ok', 'data' => $tasks]);
    }

    public function store(Request $request, string $project_id)
    {
        $request->validate([
            'status_id' => 'integer',
            'type_id' => 'required|integer',
            'title' => 'required|min:2|max:200',
            'description' => 'required|min:10',
        ]);

        try {
            Project::findOrFail($project_id);
            TaskStatus::findOrFail($request->input('status_id'));
            TaskType::findOrFail($request->input('type_id'));
        } catch (ModelNotFoundException $e) {
            return response(['status' => 'error', 'message' => 'Invalid query. Check project_id, status_id and type_id.'], 404);
        }

        $task = new Task;
        $task->project_id = $project_id;
        $task->status_id = $request->input('status_id');
        $task->type_id = $request->input('type_id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return response(['status' => 'ok', 'data' => $task]);
    }

    public function update(Request $request, string $task_id)
    {
        $request->validate([
            'type_id' => 'required|integer',
            'status_id' => 'required|integer',
            'title' => 'required|min:2|max:200',
            'description' => 'required|min:10',
        ]);

        try {
            TaskStatus::findOrFail($request->input('status_id'));
            $task = Task::findOrFail($task_id);
        } catch (ModelNotFoundException $e) {
            return  response(['status' => 'error', 'message' => 'Invalid query. Check task_id and status_id'], 404);
        }

        $task->status_id = $request->input('status_id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return response(['status' => 'ok', 'data' => $task]);
    }

    public function destroy(string $task_id)
    {
        try {
            $task = Task::findOrFail($task_id);
        } catch (ModelNotFoundException $e) {
            return  response(['status' => 'error', 'message' => 'Invalid query. Check task_id.'], 404);
        }

        if ($task->delete()) {
            return response(['status' => 'ok', 'message' => 'deleted successfully']);
        }
    }
}
