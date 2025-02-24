<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

/**
 * Controlador del Panel de Administrador (Dashboard).
 * Permite ver, editar, actualizar y eliminar el perfil del administrador.
 */
class AdminDashboardController extends Controller
{
    /**
     * Muestra el panel del administrador con su información.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $admin = Auth::user();
        return view('admin.dashboard', compact('admin'));
    }

    /**
     * Muestra el formulario de edición del perfil del administrador.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.edit-profile', compact('admin'));
    }

    /**
     * Actualiza la información del perfil del administrador.
     *
     * @param  \Illuminate\Http\Request  $request  Datos del formulario de edición.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Obtener el administrador autenticado
        $admin = Admin::find(Auth::id());

        // Verificar si el administrador existe
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Administrador no encontrado.');
        }

        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Actualizar los datos del administrador
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Actualizar la contraseña solo si se proporciona una nueva
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        // Guardar los cambios en la base de datos
        $admin->save();

        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('admin.dashboard')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del administrador autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Obtener el administrador autenticado
        $admin = Auth::user();

        // Verificar si el administrador existe
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Administrador no encontrado.');
        }

        // Cerrar la sesión antes de eliminar la cuenta
        Auth::logout();

        // Eliminar el administrador de la base de datos
        Admin::where('id', $admin->id)->delete();

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('welcome')->with('success', 'Cuenta eliminada correctamente.');
    }

    /**
 * Muestra el formulario de registro de administradores.
 *
 * @return \Illuminate\View\View
 */
public function showRegisterForm()
{
    return view('admin.register');
}
}
