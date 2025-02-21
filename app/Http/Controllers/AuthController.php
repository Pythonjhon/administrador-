<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador de autenticación para el registro, inicio y cierre de sesión.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de registro de usuario.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Maneja el registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request  Datos del formulario de registro.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir a la lista de tareas
        return redirect()->route('tasks.index');
    }

    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Maneja la autenticación del usuario.
     *
     * @param  \Illuminate\Http\Request  $request  Datos del formulario de inicio de sesión.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validar las credenciales ingresadas
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Regenerar la sesión para evitar ataques de sesión fija
            $request->session()->regenerate();
            return redirect()->route('tasks.index')->with('success', 'Inicio de sesión exitoso.');
        }

        // En caso de error, redirigir con mensaje de credenciales incorrectas
        return back()->withErrors(['email' => 'Credenciales incorrectas.'])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Cerrar sesión del usuario
        Auth::logout();

        // Invalidar la sesión actual y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir a la página de login con mensaje de éxito
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}
