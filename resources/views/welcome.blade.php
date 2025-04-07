@extends('layouts.app')
@section('title', 'Tasks')
@section('content')
    @if($tasks->isEmpty())
        <div>
            <h2>No registered tasks yet</h2>
        </div>
    @else
    <h1>Tasks</h1>
    <div>
        <a href="{{ route('newTask') }}">Create Task</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>State</th>
                <th>Expire at</th>
                <th>Priority</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->state }}</td>
                    <td>{{ $task->expiration_at }}</td>
                    <td>
                        @if($task->priority == 1)
                            High
                        @else
                            Low
                        @endif
                    </td>
                    <td>{{ $task->category }}</td>
                    <td>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
    
@endsection