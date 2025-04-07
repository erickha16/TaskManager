<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index() 
    {
        $tasks = Tasks::all();
        return view('welcome', ['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:1000',
            'state' => 'required|string|max:15',
            'expiration_at' => 'date',
            'priority' => 'required|boolean',
            'category' => 'required|string|max:15',
        ]);
        // Validate the request data
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Tasks();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->state = $request->input('state');
        $task->expiration_at = $request->input('expiration_at');
        $task->priority = $request->input('priority');
        $task->category = $request->input('category');
        $task->user_id = auth()->id(); // Assuming you have user authentication
        $task->save();

        return redirect()->route('welcome')->with('success', 'Tarea creada exitosamente');
    }

    /**
     * Display the Auth user's tasks.
     */
    public function show(){
        $tasks = Tasks::where('user_id', auth()->id())->get();
        return view('welcome', ['tasks' => $tasks]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $task = Tasks::find($request->input('id'));
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:1000',
            'state' => 'required|string|max:15',
            'expiration_at' => 'date',
            'priority' => 'required|boolean',
            'category' => 'required|string|max:15',
        ]);
        // Validate the request data
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task->update($request->all());
        return redirect()->route('welcome')->with('success', 'Tarea actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
