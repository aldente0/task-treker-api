<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index');
    Route::post('/project', 'store');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks/{project_id}', 'index');
    Route::post('/tasks/{project_id}', 'store');
    Route::put('/task/{task_id}', 'update');
    Route::delete('/task/{task_id}', 'destroy');
});
