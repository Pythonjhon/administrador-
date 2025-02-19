<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.dashboard', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
        }

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

        return redirect()->route('dashboard')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Usuario no encontrado.');
        }

        Auth::logout(); // Cierra la sesión antes de eliminar la cuenta

        User::where('id', $user->id)->delete(); // Se usa `where` para asegurarnos de que se ejecuta correctamente

        return redirect()->route('welcome')->with('success', 'Cuenta eliminada correctamente.');
    }
}
