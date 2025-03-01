<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/addTask', [TaskController::class, 'insert']);
    Route::post('/updateTask/{taskId}', [TaskController::class, 'update']);
    Route::get('/myTasks', [TaskController::class, 'indexByUser']);
    Route::delete('/remove/{taskId}', [TaskController::class, 'remove']);
    Route::get('/stats', [TaskController::class, 'stats']);
    Route::get('/task/{taskId}', [TaskController::class, 'task']);
});