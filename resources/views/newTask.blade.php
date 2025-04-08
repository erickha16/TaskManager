@extends('layouts.app')
@section('title', 'Create Task')
@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Create New Task</h1>
            </div>
            
            <form action="{{ route('newTask.post') }}" method="POST" class="px-6 py-4">
                @csrf
                
                <!-- Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Description Input -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <!-- Grid for State, Date, Priority and Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- State Select -->
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                        <select name="state" id="state" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pendiente">Pending</option>
                            <option value="en progreso">In Progress</option>
                            <option value="completada">Completed</option>
                        </select>
                    </div>

                    <!-- Expiration Date -->
                    <div>
                        <label for="expiration_at" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" name="expiration_at" id="expiration_at"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Priority Select -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority*</label>
                        <select name="priority" id="priority" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="0">Low Priority</option>
                            <option value="1">High Priority</option>
                        </select>
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                        <select name="category" id="category" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
     // Función para mostrar el toast
     function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        
        // Configura el mensaje y el color según el tipo
        toastMessage.textContent = message;
        toast.className = `fixed bottom-4 right-4 z-50 flex items-center p-4 w-full max-w-xs rounded-lg shadow-lg toast-transition toast-show ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} text-white`;
        
        // Oculta automáticamente después de 3 segundos
        setTimeout(() => {
            hideToast();
        }, 3000);
    }

    // Función para ocultar el toast
    function hideToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('toast-hide');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('toast-show', 'toast-hide');
        }, 300);
    }

    // Mostrar mensaje de éxito al cargar la página si existe en la sesión
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si hay mensaje de éxito en la sesión
        const successMessage = '{{ session('success') }}';
        if (successMessage && successMessage !== '') {
            showToast(successMessage, 'success');
        }
    });
</script>
@endsection