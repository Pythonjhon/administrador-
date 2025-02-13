<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
    
        $query = Task::query();
    
        if ($filter === 'completed') {
            $query->where('completed', true);
        } elseif ($filter === 'pending') {
            $query->where('completed', false);
        }
    
        $tasks = $query->paginate(5); // Paginación de 5 tareas por página
    
        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Task::create($request->all());

    return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
}


    public function edit($id) {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $task->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
}

public function destroy(Task $task)
{
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Tarea eliminada.');
}

public function toggle(Task $task)
{
    $task->completed = !$task->completed;
    $task->save();

    $message = $task->completed ? 'Tarea marcada como completada.' : 'Tarea marcada como pendiente.';

    return redirect()->route('tasks.index')->with('success', $message);
}

}
