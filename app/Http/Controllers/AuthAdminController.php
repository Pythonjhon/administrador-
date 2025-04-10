<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

class AuthAdminController extends Controller
{
    /**
     * Muestra el formulario de registro de administradores.
     */
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    /**
     * Procesa el registro de un nuevo administrador.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Registro exitoso.');
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Procesa el inicio de sesión.
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
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }

    /**
     * Muestra el formulario de edición del perfil.
     */
    public function editProfile()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }

        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Actualiza los datos del perfil del administrador.
     */
    public function update(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión.');
        }
    
        $admin = Auth::guard('admin')->user();
    
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'No se encontró el administrador.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        // Actualizar los datos básicos
        $admin->name = $request->name;
        $admin->email = $request->email;
        
        // Actualizar la contraseña solo si se proporciona
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        
        // Guardar los cambios
        $admin = Admin::find(Auth::guard('admin')->id());
        $admin->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Perfil actualizado correctamente.');
    }
}
