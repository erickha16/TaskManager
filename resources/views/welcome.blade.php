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
                        <a href="{{ route('updateTask', ['id' => $task->id]) }}">Edit</a>                       
                        <button type="button" class="btn-delete" data-id="{{ $task->id }}" >Delete</button>                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
    
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.getElementsByClassName('btn-delete');
            for(button of deleteButtons) {
                button.addEventListener('click', function() {
                    const taskId = this.getAttribute('data-id');
                    const options = {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ id: taskId })
                    }
                    console.log(options);
                    fetch('/api/delete-task', options)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        if (data.success) {
                            button.parentElement.parentElement.remove();
                           
                        }})
                    .catch(error => {
                        console.error('Error:', error);
                    }); 
                });
            }
        });
    </script>
@endsection