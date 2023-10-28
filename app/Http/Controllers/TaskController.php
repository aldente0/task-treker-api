<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(string $project_id)
    {
        $tasks = DB::table('tasks')
            ->join('projects', 'project_id', '=', 'projects.id')
            ->join('task_statuses', 'status_id', '=', 'task_statuses.id')
            ->join('task_types', 'type_id', '=', 'task_types.id')
            ->select('tasks.id', 'projects.name as project', 'task_statuses.name as status', 'task_types.name as type', 'title', 'description')
            ->where('projects.id', '=', $project_id)
            ->get();

        return $tasks;
    }

    public function store(Request $request, string $project_id)
    {
        $request->validate([
            'type_id' => 'required|integer',
            'title' => 'required|min:2|max:200',
            'description' => 'required|min:10',
        ]);

        $task = new Task;
        $task->project_id = $project_id;
        $task->status_id = 1;
        $task->type_id = $request->input('type_id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return ['message' => 'added new task successfully'];
    }

    public function update(Request $request, string $task_id)
    {
        $request->validate([
            'status_id' => 'required|integer',
            'title' => 'required|min:2|max:200',
            'description' => 'required|min:10'
        ]);

        $task = Task::findOrFail($task_id);
        $task->status_id = $request->input('status_id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return ['message' => 'updated successfully'];
    }

    public function destroy(string $task_id)
    {
        $task = Task::findOrFail($task_id);
        if ($task->delete()) {
            return ['message' => 'deleted successfully'];
        }
    }
}
