@extends('layouts.app')
@section('title', 'Edit Task')
@section('content')
    <h1>Edit Task</h1>
    <form action="" method="POST">
        @csrf
        <div>
            <label for="task_id">Task_ID: {{ $task->id }} </label>
            <input type="hidden" name="id" id="id" value="{{  $task->id }}" required>
        </div>
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ $task->description }}</textarea>
        </div>
        <div>
            <label for="state">State:</label>
            <select name="state" id="state">
                <option value="pendiente" {{ $task->state == 'pendiente' ? 'selected' : ''}}>Pending</option>
                <option value="en progreso" {{ $task->state == 'en progreso' ? 'selected' : ''}}>On progres</option>
                <option value="completada" {{ $task->state == 'completada' ? 'selected' : ''}}>Completed</option>
            </select>
        </div>
        <div>
            <label for="expiration_at">Expiration Date:</label>
            <input type="date" name="expiration_at" id="expiration_at" value="{{ $task->expiration_at }}">
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" value="{{ $task->priority }}">
                <option value="1" {{ $task->priority == '1' ? 'selected' : ''}}>High</option>
                <option value="0" {{ $task->priority == '0' ? 'selected' : ''}}>Low</option>
            </select>
        </div>
        <div>
            <label for="category">Category:</label>
            <select name="category" id="category" value="{{ $task->category }}">
                <option value="trabajo" {{ $task->category == 'trabajo' ? 'selected' : ''}}>Work</option>
                <option value="estudio" {{ $task->category == 'estudio' ? 'selected' : ''}}>Study</option>
                <option value="casa" {{ $task->category == 'casa' ? 'selected' : ''}}>Home</option>
                <option value="personal" {{ $task->category == 'personal' ? 'selected' : ''}}>Personal</option>
                <option value="finanzas" {{ $task->category == 'finanzas' ? 'selected' : ''}}>Finance</option>
                <option value="salud" {{ $task->category == 'salud' ? 'selected' : ''}}>Health</option>
                <option value="viaje" {{ $task->category == 'viaje' ? 'selected' : ''}}>Trip</option>
                <option value="social" {{ $task->category == 'social' ? 'selected' : ''}}>Social</option>
                <option value="tecnologia" {{ $task->category == 'tecnologia' ? 'selected' : ''}}>Technology</option>
            </select>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit">Update Task</button>
    </form>
@endsection