<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        // Obtener el usuario autenticado
        $user = User::find(Auth::id());

        // Verificar si el usuario existe
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
        }

        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Actualizar la contraseña solo si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Guardar los cambios en la base de datos
        $user->save();

        // Redirigir al dashboard con un mensaje de éxito
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
