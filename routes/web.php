<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;


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

Route::get('/update-task', function () {
    return view('updateTask');
})->name('updateTask')->middleware('auth');


//POST
Route::post('/create-task', [TasksController::class, 'store'])->name('newTask.post')->middleware('auth');



