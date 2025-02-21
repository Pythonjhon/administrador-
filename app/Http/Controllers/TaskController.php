<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para la gestión de tareas.
 */
class TaskController extends Controller
{
    /**
     * Muestra una lista paginada de tareas con la opción de filtrado por estado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        // Filtrar tareas según su estado (completadas o pendientes)
        $tasks = Task::when($filter === 'completed', fn($query) => $query->where('completed', true))
                     ->when($filter === 'pending', fn($query) => $query->where('completed', false))
                     ->paginate(10);

        return view('tasks.index', compact('tasks', 'filter'));
    }

    /**
     * Muestra el formulario de creación de una nueva tarea.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(); // Obtener todos los usuarios para asignación
        return view('tasks.create', compact('users'));
    }

    /**
     * Almacena una nueva tarea en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        // Guardar imagen y archivo si se adjuntan
        $imagePath = $request->file('image')?->store('tasks', 'public');
        $archivoPath = $request->file('archivo')?->store('tasks/files', 'public');

        // Crear la tarea con los datos proporcionados
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

    /**
     * Muestra el formulario de edición de una tarea existente.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $users = User::all(); // Obtener todos los usuarios para asignación
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Actualiza una tarea en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        // Validar datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);

        // Actualizar datos de la tarea
        $task->title = $request->title;
        $task->description = $request->description;
        $task->assigned_to = $request->assigned_to;
        $task->completed = $request->completed;

        // Manejo de la imagen: eliminar la anterior si se sube una nueva
        if ($request->hasFile('image')) {
            if ($task->image) {
                Storage::delete('public/' . $task->image);
            }
            $task->image = $request->file('image')->store('tasks', 'public');
        }

        // Manejo del archivo: eliminar el anterior si se sube uno nuevo
        if ($request->hasFile('archivo')) {
            if ($task->archivo) {
                Storage::delete('public/' . $task->archivo);
            }
            $task->archivo = $request->file('archivo')->store('tasks/files', 'public');
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Elimina una tarea y sus archivos asociados.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        // Eliminar archivos asociados si existen
        Storage::disk('public')->delete([$task->image, $task->archivo]);

        // Eliminar la tarea de la base de datos
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }
}
