<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Despliega la vista Tasks y proporciona la lista de tareas.
     */
    public function index() 
    {
        //Realizar la consulta a la base de datos
        $tasks = Tasks::all();
        return view('welcome', ['tasks' => $tasks]);
    }

    /**
     * Crea una nueva tarea.
     */
    public function store(Request $request)
    {        
        //Validar los datos
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'nullable|string|max:1000',
            'state' => 'required|string|max:15',
            'expiration_at' => 'nullable|date',
            'priority' => 'required|boolean',
            'category' => 'required|string|max:15',
        ]);
        // Si falla, redirigir de nuevo con los errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Crear la tarea
        $task = new Tasks();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->state = $request->input('state');
        $task->expiration_at = $request->input('expiration_at');
        $task->priority = $request->input('priority');
        $task->category = $request->input('category');
        $task->user_id = auth()->id(); // Asiganmos el id del usuario autenticado
        $task->save();

        // Redirigir a la vista de tareas con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Task created successfully');
    }

    /**
     * Display the Auth user's tasks.
     */
    public function show(){
        $tasks = Tasks::where('user_id', auth()->id())->get();
        return view('welcome', ['tasks' => $tasks]);

    }

    /**
     * Edita una tarea existente.
     */
    public function update(Request $request, int $id){
        //Busca la tarea por id
        $task = Tasks::find($id);
        // Si no existe, redirigir de nuevo con un error
        if (!$task) {
            return redirect()->back()
                ->withErrors(['task' => 'Task not found'])
                ->withInput();
        }
        // Validar los datos
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'nullable|string|max:1000',
            'state' => 'required|string|max:15',
            'expiration_at' => 'nullable|date',
            'priority' => 'required|boolean',
            'category' => 'required|string|max:15',
        ]);
        // Si falla, redirigir de nuevo con los errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Actualizar la tarea
        $task->update($request->all());
        // Redirigir a la vista de tareas con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Task updated successfully');
    }

    /**
     * Elimina una tarea existente.
     */
    public function destroy(Request $request){
        // Validar el id de la tarea
        $task = Tasks::find($request->input('id'));
        // Si no existe, retorna un json con un error 
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ]);
        }
        //Eliminar la tarea
        $task->delete();

        //Retornar una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    }
    
}
