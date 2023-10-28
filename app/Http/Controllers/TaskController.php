<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(string $id)
    {
        return json_encode(['data' => Task::where('project_id', $id)->get()]);
    }
}
