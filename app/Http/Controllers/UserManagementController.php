<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class UserManagementController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index()
{
    $users = User::with('tasks')->get();
    return view('users.index', compact('users'));
}

    /**
     * Muestra el formulario de edición de un usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza los datos del usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Muestra el formulario para asignar tareas a un usuario.
     */
    public function assignTaskForm($id)
    {
        $user = User::findOrFail($id);
        return view('users.assign-task', compact('user'));
    }

    /**
     * Asigna una tarea a un usuario.
     */
    public function assignTask(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);
    
        // Subir imagen si está presente
        $imagePath = $request->file('image') ? $request->file('image')->store('tasks/images', 'public') : null;
    
        // Subir archivo adjunto si está presente
        $archivoPath = $request->file('archivo') ? $request->file('archivo')->store('tasks/files', 'public') : null;
    
        // Crear la tarea con el usuario asignado
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed,
            'image' => $imagePath,
            'archivo' => $archivoPath,
            'assigned_to' => $request->user_id, // Aquí se asigna correctamente al usuario específico
        ]);
    
        return redirect()->route('users.index')->with('success', 'Tarea asignada correctamente.');
    }
}

