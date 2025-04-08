@extends('layouts.app')
@section('title', 'Edit Task')
@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Edit Task #{{ $task->id }}</h1>
            </div>
            
            <form action="" method="POST" class="px-6 py-4">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}">

                <!-- Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Description Input -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                    <textarea name="description" id="description" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Grid for State, Date, Priority and Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- State Select -->
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                        <select name="state" id="state" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pendiente" {{ old('state', $task->state) == 'pendiente' ? 'selected' : '' }}>Pending</option>
                            <option value="en progreso" {{ old('state', $task->state) == 'en progreso' ? 'selected' : '' }}>In Progress</option>
                            <option value="completada" {{ old('state', $task->state) == 'completada' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Expiration Date -->
                    <div>
                        <label for="expiration_at" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" name="expiration_at" id="expiration_at" value="{{ old('expiration_at', $task->expiration_at) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Priority Select -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority*</label>
                        <select name="priority" id="priority" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="0" {{ old('priority', $task->priority) == '0' ? 'selected' : '' }}>Low Priority</option>
                            <option value="1" {{ old('priority', $task->priority) == '1' ? 'selected' : '' }}>High Priority</option>
                        </select>
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                        <select name="category" id="category" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="trabajo" {{ old('category', $task->category) == 'trabajo' ? 'selected' : '' }}>Work</option>
                            <option value="estudio" {{ old('category', $task->category) == 'estudio' ? 'selected' : '' }}>Study</option>
                            <option value="casa" {{ old('category', $task->category) == 'casa' ? 'selected' : '' }}>Home</option>
                            <option value="personal" {{ old('category', $task->category) == 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="finanzas" {{ old('category', $task->category) == 'finanzas' ? 'selected' : '' }}>Finance</option>
                            <option value="salud" {{ old('category', $task->category) == 'salud' ? 'selected' : '' }}>Health</option>
                            <option value="viaje" {{ old('category', $task->category) == 'viaje' ? 'selected' : '' }}>Trip</option>
                            <option value="social" {{ old('category', $task->category) == 'social' ? 'selected' : '' }}>Social</option>
                            <option value="tecnologia" {{ old('category', $task->category) == 'tecnologia' ? 'selected' : '' }}>Technology</option>
                        </select>
                    </div>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('welcome') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection