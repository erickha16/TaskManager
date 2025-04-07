@extends('layouts.app')
@section('title', 'Create Task')
@section('content')
    <h1>Create Task</h1>
    <form action="{{ route('newTask.post') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="state">State:</label>
            <select name="state" id="state">
                <option value="pendiente">Pending</option>
                <option value="en progreso">On progres</option>
                <option value="completada">Completed</option>
            </select>
        </div>
        <div>
            <label for="expiration_at">Expiration Date:</label>
            <input type="date" name="expiration_at" id="expiration_at">
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select name="priority" id="priority">
                <option value="1">High</option>
                <option value="0">Low</option>
            </select>
        </div>
        <div>
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="trabajo">Work</option>
                <option value="estudio">Study</option>
                <option value="casa">Home</option>
                <option value="personal">Personal</option>
                <option value="finanzas">Finance</option>
                <option value="salud">Health</option>
                <option value="viaje">Trip</option>
                <option value="social">Social</option>
                <option value="tecnologia">Technology</option>
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
        <button type="submit">Create Task</button>
    </form>
@endsection