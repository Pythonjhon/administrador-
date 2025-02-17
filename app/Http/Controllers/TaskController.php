<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'assigned_to' => 'required|string|max:255',
        'completed' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validación de imagen
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('tasks', 'public'); // Guarda la imagen en storage/app/public/tasks
    }

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'assigned_to' => $request->assigned_to,
        'completed' => $request->completed,
        'image' => $imagePath,
    ]);

    return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
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
        'assigned_to' => 'required|string|max:255',
        'completed' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        if ($task->image) {
            Storage::delete('public/' . $task->image); // Elimina la imagen anterior si existe
        }
        $task->image = $request->file('image')->store('tasks', 'public');
    }

    $task->update($request->only(['title', 'description', 'assigned_to', 'completed', 'image']));

    return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
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
