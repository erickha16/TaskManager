@extends('layouts.app')
@section('title', 'Tasks')
@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Tasks</h1>
            <a href="{{ route('newTask') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create Task
            </a>
        </div>

        @if($tasks->isEmpty())
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h2 class="mt-2 text-lg font-medium text-gray-900">No tasks yet</h2>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new task.</p>
            <div class="mt-6">
                <a href="{{ route('newTask') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create First Task
                </a>
            </div>
        </div>
        @else
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                        <tr class="{{ $task->priority ? 'bg-red-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $task->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate">{{ $task->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $stateColors = [
                                        'pendiente' => 'bg-yellow-100 text-yellow-800',
                                        'en progreso' => 'bg-blue-100 text-blue-800',
                                        'completada' => 'bg-green-100 text-green-800'
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $stateColors[$task->state] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($task->state) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $task->expiration_at ? \Carbon\Carbon::parse($task->expiration_at)->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($task->priority == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">High</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Low</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ ucfirst($task->category) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <!-- Botón Edit con icono -->
                                    <a href="{{ route('updateTask', ['id' => $task->id]) }}" 
                                    class="inline-flex items-center px-3 py-1 border border-indigo-600 rounded-md text-sm font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    
                                    <!-- Botón Delete con icono -->
                                    <button type="button" 
                                            class="inline-flex items-center px-3 py-1 border border-red-600 rounded-md text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 btn-delete" 
                                            data-id="{{ $task->id }}">
                                        <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>


<!-- Modal de Confirmación -->
<div id="modalBackdrop" class="hidden fixed inset-0 z-50 items-center justify-center  p-4 backdrop-blur-sm">
    <!-- Contenido del Modal -->
    <div class="relative  mt-64 bg-white rounded-lg shadow-xl max-w-md w-full mx-auto overflow-hidden">
        <div class="p-6 ">
            <div class="flex items-start ">
                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">Delete Task</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to delete this task? This action cannot be undone.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botones de acción -->
        <div class="bg-gray-50 px-4 py-3 flex flex-row-reverse">
            <button type="button" id="confirmDeleteBtn" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Delete
            </button>
            <button type="button" id="cancelDeleteBtn" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

    // ------------------------------- Funciones del Toast ------------------------------- //
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
    // ------------------------------- Funciones del Modal ------------------------------- //
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        
        let currentTaskId = null;
        let currentButton = null;

        // Abrir modal al hacer clic en Delete
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                currentTaskId = this.getAttribute('data-id');
                currentButton = this;
                modalBackdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Previene el scroll
            });
        });

        // Confirmar eliminación, lo haremos como si estuvieamos consumiendo una API
        confirmDeleteBtn.addEventListener('click', function() {
            if (!currentTaskId) return;
            const options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ id: currentTaskId })
            };

            fetch('/api/delete-task', options)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Animación para eliminar la fila
                        const row = currentButton.closest('tr');
                        row.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                        setTimeout(() => row.remove(), 300);

                        // MOSTRAR TOAST DE ÉXITO - ESTA ES LA LÍNEA QUE FALTABA
                        showToast('Task deleted successfully', 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
                .finally(() => {
                    closeModal();
                });
        });

        // Cancelar eliminación
        cancelDeleteBtn.addEventListener('click', closeModal);

        // Cerrar al hacer clic fuera del modal
        modalBackdrop.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Función para cerrar el modal
        function closeModal() {
            modalBackdrop.classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentTaskId = null;
            currentButton = null;
        }

        // Cerrar con tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modalBackdrop.classList.contains('hidden')) {
                closeModal();
            }
        });
    });

    
</script>

<style>
    .toast-transition {
        transition: all 0.3s ease-in-out;
    }
    .toast-show {
        animation: toast-in 0.3s ease-out;
    }
    .toast-hide {
        animation: toast-out 0.3s ease-in;
    }
    @keyframes toast-in {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes toast-out {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
</style>
@endsection