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
    public function update(Request $request)
{
    $user = Auth::user(); // Obtiene el usuario autenticado

    if (!$user) {
        return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
    }

    // Validación de los datos
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'job' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Actualizar datos básicos
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    if (isset($request->job)) {
        $user->job = $request->job;
    }

    // Manejo de la imagen: eliminar la anterior si se sube una nueva
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }
        $user->image = $request->file('image')->store('profile_images', 'public');
    }

    $user->save();

    return redirect()->route('dashboard')->with('success', 'Perfil actualizado correctamente.');
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
