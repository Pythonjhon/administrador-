<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('tasks')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function assignTaskForm($id = null)
    {
        $user = null;
        $users = [];

        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $users = User::all();
        }

        return view('users.assign-task', compact('user', 'users'));
    }

    public function bulkAssignTaskForm()
    {
        $users = User::all();
        return view('users.bulk-assign-task', compact('users'));
    }

    public function assignTask(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tasks/images', 'public');
        }

        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('tasks/files', 'public');
        }

        $taskId = \DB::table('tasks')->insertGetId([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'completed' => $validatedData['completed'] ? 1 : 0,
            'image' => $imagePath,
            'archivo' => $archivoPath,
            'assigned_to' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('users.index')->with('success', "Tarea #{$taskId} asignada exitosamente a {$user->name}");
    }

    public function bulkAssignTask(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('tasks/images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

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

    public function assignTaskToAllUsers(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo' => 'nullable|mimes:pdf,doc,docx,xlsx,csv|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('tasks/images', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            try {
                $archivoPath = $request->file('archivo')->store('tasks/files', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
            }
        }

        $users = User::all();
        $createdCount = 0;
        $errorCount = 0;

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
