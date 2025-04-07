<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use \App\Models\Tasks;


//Rutas de autenticación
Route::get('/signup', function () {
    return view('signUp');
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');

//POST
Route::post('/signup', [UsersController::class, 'store'])->name('signup.post');
Route::post('/login', [UsersController::class, 'login'])->name('login.post');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');


//Rutas de tareas(Tasks)
Route::get('/', [TasksController::class, 'show'])->name('welcome')->middleware('auth');

Route::get('/create-task', function () {
    return view('newTask');
})->name('newTask')->middleware('auth');

Route::get('/update-task/{id}', function ($id) {
    $task = Tasks::find($id);
    if (!$task) {
        return redirect()->back()
            ->withErrors(['task' => 'Tarea no encontrada'])
            ->withInput();   
    }

    return view('updateTask', ['task' => $task]);
})->name('updateTask')->middleware('auth');


//POST
Route::post('/create-task', [TasksController::class, 'store'])->name('newTask.post')->middleware('auth');
Route::post('/update-task/{id}', [TasksController::class, 'update'])->name('updateTask.post')->middleware('auth');



