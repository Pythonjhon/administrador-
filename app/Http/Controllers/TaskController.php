<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Muestra la lista de tareas.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $tasks = Task::when($filter === 'completed', fn($query) => $query->where('completed', true))
                     ->when($filter === 'pending', fn($query) => $query->where('completed', false))
                     ->paginate(10);

        return view('tasks.index', compact('tasks', 'filter'));
    }

    /**
     * Muestra el formulario de creación de tareas.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Almacena una nueva tarea.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|string|max:255', // Validación para la persona asignada
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Muestra el formulario de edición de tareas.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualiza una tarea.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|string|max:255', // Validación para la persona asignada
            'completed' => 'boolean',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Cambia el estado de la tarea.
     */
    public function toggle(Task $task)
    {
        $task->update(['completed' => !$task->completed]);

        return redirect()->route('tasks.index')->with('success', 'Estado de la tarea actualizado.');
    }

    /**
     * Elimina una tarea.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }
}
