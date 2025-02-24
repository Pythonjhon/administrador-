<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthAdminController extends Controller
{
    /**
     * Muestra el formulario de registro de administradores.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('admin.register'); // Asegúrate de que esta vista exista en resources/views/admin/register.blade.php
    }

    /**
     * Procesa el registro de un nuevo administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Crear un nuevo administrador
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
        ]);

        // Autenticar al nuevo administrador
        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Registro exitoso.');
    }

    /**
     * Muestra el formulario de inicio de sesión para administradores.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Procesa el inicio de sesión del administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors(['email' => 'Las credenciales no coinciden.'])->withInput();
    }

    /**
     * Cierra la sesión del administrador.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }
}
