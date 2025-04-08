<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use \App\Models\Tasks;


// ------------- Rutas de autenticación ------------- //
//Crear un nuevo usuario
Route::get('/signup', function () {
    return view('signUp');
})->name('signup');

//Iniciar sesión
Route::get('/login', function () {
    return view('login');
})->name('login');

//POST (Acciones de autenticación)
Route::post('/signup', [UsersController::class, 'store'])->name('signup.post');
Route::post('/login', [UsersController::class, 'login'])->name('login.post');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');


//---------------- Rutas de tareas(Tasks) -----------------//
//Mostrar todas las tareas
Route::get('/', [TasksController::class, 'show'])->name('welcome')->middleware('auth');

//Crear una nueva tarea
Route::get('/create-task', function () {
    return view('newTask');
})->name('newTask')->middleware('auth');

//Editar una tarea específica
Route::get('/update-task/{id}', function ($id) {
    //Encontrar la tarea por ID
    $task = Tasks::find($id);
    //Si no se encuentra la tarea, redirigir con un mensaje de error
    if (!$task) {
        return redirect()->back()
            ->withErrors(['task' => 'Tarea no encontrada'])
            ->withInput();   
    }
    //Si la tarea existe, mostrar la vista de edición provee la tarea para mostrar sus datos
    return view('updateTask', ['task' => $task]);
})->name('updateTask')->middleware('auth');


//POST
Route::post('/create-task', [TasksController::class, 'store'])->name('newTask.post')->middleware('auth');
Route::post('/update-task/{id}', [TasksController::class, 'update'])->name('updateTask.post')->middleware('auth');



