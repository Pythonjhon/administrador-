<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador del Panel de Usuario (Dashboard).
 * Permite ver, editar, actualizar y eliminar el perfil del usuario.
 */
class DashboardController extends Controller
{
    /**
     * Muestra el panel de usuario con su información.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('auth.dashboard', compact('user'));
    }

    /**
     * Muestra el formulario de edición del perfil del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    /**
     * Actualiza la información del perfil del usuario.
     *
     * @param  \Illuminate\Http\Request  $request  Datos del formulario de edición.
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
        'password' => 'nullable|min:6|confirmed',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'job' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Si el usuario subió una nueva imagen, la almacenamos
    if ($request->hasFile('image')) {
        // Eliminamos la imagen anterior si existe
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }
        // Guardamos la nueva imagen
        $validatedData['image'] = $request->file('image')->store('profile_images', 'public');
    }

    // Si hay contraseña, la encriptamos antes de actualizar
    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($request->password);
    } else {
        unset($validatedData['password']); // Eliminamos la clave si no se actualiza
    }

    // Actualizamos los datos del usuario sin usar `save()`
    User::where('id', $user->id)->update($validatedData);

    return redirect()->route('dashboard')->with('success', 'Perfil actualizado correctamente.');
}


    /**
     * Elimina la cuenta del usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario existe
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
        }

        // Cerrar la sesión antes de eliminar la cuenta
        Auth::logout();

        // Eliminar el usuario de la base de datos
        User::where('id', $user->id)->delete();

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Cuenta eliminada correctamente.');
    }
}
