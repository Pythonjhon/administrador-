<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $tasks = Task::when($filter === 'completed', fn($query) => $query->where('completed', true))
                     ->when($filter === 'pending', fn($query) => $query->where('completed', false))
                     ->paginate(10);

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function create()
{
    $users = User::all(); // Obtener todos los usuarios
    return view('tasks.create', compact('users'));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $imagePath = $request->file('image')?->store('tasks', 'public');
        $archivoPath = $request->file('archivo')?->store('tasks/files', 'public');

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'completed' => $request->completed,
            'image' => $imagePath,
            'archivo' => $archivoPath,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
    }

    public function edit(Task $task)
    {
        $users = User::all(); // Obtener todos los usuarios para la asignación de tareas
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'assigned_to' => 'nullable|exists:users,id',
        'completed' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120', // Cambié 'file' por 'archivo'
    ]);

    // Actualizar los campos de la tarea
    $task->title = $request->title;
    $task->description = $request->description;
    $task->assigned_to = $request->assigned_to;
    $task->completed = $request->completed;

    // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
    if ($request->hasFile('image')) {
        if ($task->image) {
            Storage::delete('public/' . $task->image);
        }
        $task->image = $request->file('image')->store('tasks', 'public');
    }

    // Si se sube un nuevo archivo, eliminar el anterior y guardar el nuevo
    if ($request->hasFile('archivo')) { // Aquí corregí 'file' por 'archivo'
        if ($task->archivo) { // Aquí también
            Storage::delete('public/' . $task->archivo);
        }
        $task->archivo = $request->file('archivo')->store('tasks/files', 'public'); // Aquí también
    }

    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
}

    public function destroy(Task $task)
    {
        Storage::disk('public')->delete([$task->image, $task->archivo]);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }
}

