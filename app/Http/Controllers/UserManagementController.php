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
        $users = User::with('tasks')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario de edición de un usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Puedes descomentar esta línea si tienes políticas de autorización configuradas
        // $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza los datos del usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Puedes descomentar esta línea si tienes políticas de autorización configuradas
        // $this->authorize('update', $user);

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
        // Puedes descomentar esta línea si tienes políticas de autorización configuradas
        // $this->authorize('delete', $user);
        
        // Opción 1: Eliminar las tareas asociadas
        // $user->tasks()->delete();
        
        // Opción 2: Reasignar las tareas (descomentar la opción que prefieras)
        // $user->tasks()->update(['assigned_to' => null]);
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Muestra el formulario para asignar tareas a un usuario.
     */
    public function assignTaskForm($id = null)
    {
        $user = null;
        $users = [];
        
        if ($id) {
            // Si se proporciona un ID, solo mostrar ese usuario
            $user = User::findOrFail($id);
        } else {
            // Si no hay ID, mostrar todos los usuarios para selección múltiple
            $users = User::all();
        }
        
        return view('users.assign-task', compact('user', 'users'));
    }

    /**
     * Muestra el formulario para asignar tareas a múltiples usuarios.
     */
    public function bulkAssignTaskForm()
    {
        $users = User::all();
        return view('users.bulk-assign-task', compact('users'));
    }

    /**
     * Asigna una tarea a un usuario específico.
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
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('tasks/images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }
    
        // Subir archivo adjunto si está presente
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            try {
                $archivoPath = $request->file('archivo')->store('tasks/files', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
            }
        }
    
        // Crear la tarea con el usuario asignado
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'completed' => $request->boolean('completed'),
                'image' => $imagePath,
                'archivo' => $archivoPath,
                'assigned_to' => $request->user_id,
            ]);
            
            return redirect()->route('users.index')->with('success', 'Tarea asignada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear la tarea: ' . $e->getMessage());
        }
    }

    /**
     * Asigna una tarea a múltiples usuarios.
     */
    public function bulkAssignTask(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);
    
        // Subir imagen si está presente (se utilizará la misma para todas las tareas)
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('tasks/images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }
    
        // Subir archivo adjunto si está presente (se utilizará el mismo para todas las tareas)
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            try {
                $archivoPath = $request->file('archivo')->store('tasks/files', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
            }
        }
    
        $createdCount = 0;
        $errorCount = 0;
    
        // Crear una tarea para cada usuario seleccionado
        foreach ($request->user_ids as $userId) {
            try {
                Task::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'completed' => $request->boolean('completed'),
                    'image' => $imagePath,
                    'archivo' => $archivoPath,
                    'assigned_to' => $userId,
                ]);
                $createdCount++;
            } catch (\Exception $e) {
                $errorCount++;
            }
        }
    
        if ($errorCount > 0) {
            return redirect()->route('users.index')->with('warning', "Tareas asignadas: $createdCount. Errores: $errorCount");
        }
    
        return redirect()->route('users.index')->with('success', "Tarea asignada correctamente a $createdCount usuarios.");
    }

    /**
     * Asigna una tarea a todos los usuarios.
     */
    public function assignTaskToAllUsers(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);
    
        // Subir imagen si está presente (se utilizará la misma para todas las tareas)
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('tasks/images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }
    
        // Subir archivo adjunto si está presente (se utilizará el mismo para todas las tareas)
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            try {
                $archivoPath = $request->file('archivo')->store('tasks/files', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
            }
        }
    
        // Obtener todos los usuarios
        $users = User::all();
        $createdCount = 0;
        $errorCount = 0;
    
        // Crear una tarea para cada usuario
        foreach ($users as $user) {
            try {
                Task::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'completed' => $request->boolean('completed'),
                    'image' => $imagePath,
                    'archivo' => $archivoPath,
                    'assigned_to' => $user->id,
                ]);
                $createdCount++;
            } catch (\Exception $e) {
                $errorCount++;
            }
        }
    
        if ($errorCount > 0) {
            return redirect()->route('users.index')->with('warning', "Tareas asignadas: $createdCount. Errores: $errorCount");
        }
    
        return redirect()->route('users.index')->with('success', "Tarea asignada correctamente a todos los usuarios ($createdCount).");
    }
}