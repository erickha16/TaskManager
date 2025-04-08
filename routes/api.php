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
Route::post('/users/logout', [UsersController::class, 'logout'])->middleware('auth:sanctum'); // Cerrar sesión
/* NOTA: Estos endpoints se crearon para el consumo de la API, sin embargo no se usaron de esta manera ya que el
    Framework de Laravelofrece un sistema de autenticación y autorización que se puede usar para proteger los endpoints
    y no es necesario crear un sistema de autenticación y autorización desde cero. Por lo tanto, estos endpoints no se usaron
    en la aplicación. Sin embargo, se dejaron aquí como referencia para el futuro.
    Además, el sistema de autenticación y autorización de Laravel es fácil de usar y se integra perfectamente con el resto del framework. 
*/

// --------------- Resource para tareas (Tasks) ----------------- //
//Eliminar tareas
Route::delete('/delete-task', [TasksController::class, 'destroy']);