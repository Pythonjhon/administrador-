<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

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
        // Verifica si hay un administrador autenticado
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }

    /**
     * Muestra el formulario de edición del perfil del administrador.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        $admin = Auth::guard('admin')->user();
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
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }
        
        $admin = Auth::guard('admin')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:15', // Validación para el teléfono
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para imagen
            'address' => 'nullable|string|max:500', // Validación para dirección
            'password' => 'nullable|min:6|confirmed',
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $imagePath;
        }
    
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        
        Admin::where('id', $admin->id)->update($data);
        
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
