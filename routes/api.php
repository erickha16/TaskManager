<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoints para usuarios
Route::get('/users', [UsersController::class, 'index']); // Listar todos
Route::get('/users/{id}', [UsersController::class, 'show']); // Mostrar uno
Route::post('/users/login', [UsersController::class, 'login']); // Autenticar
Route::post('/users/logout', [UsersController::class, 'logout'])->middleware('auth:sanctum');

// Resource para tareas
Route::delete('/delete-task', [TasksController::class, 'destroy']);