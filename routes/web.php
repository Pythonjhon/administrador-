<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/**
 * Rutas principales de la aplicación.
 */

/**
 * Ruta de bienvenida.
 * Muestra la vista principal de la aplicación.
 */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * Rutas de autenticación.
 * Manejan el registro, inicio de sesión y cierre de sesión de usuarios.
 */
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Muestra el formulario de registro.
Route::post('/register', [AuthController::class, 'register']); // Procesa el registro de usuarios.

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Muestra el formulario de inicio de sesión.
Route::post('/login', [AuthController::class, 'login']); // Procesa el inicio de sesión.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Cierra la sesión del usuario.

/**
 * Rutas protegidas por middleware de autenticación.
 * Solo accesibles para usuarios autenticados.
 */
Route::middleware('auth')->group(function () {
    /**
     * Dashboard del usuario autenticado.
     * Muestra información relevante y opciones del usuario.
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Edición del perfil del usuario.
     * Permite a los usuarios actualizar su información personal.
     */
    Route::get('/profile/edit', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [DashboardController::class, 'update'])->name('profile.update');

    /**
     * Eliminación del perfil del usuario.
     * Permite a los usuarios eliminar su cuenta de manera permanente.
     */
    Route::delete('/profile/delete', [DashboardController::class, 'destroy'])->name('profile.delete');
});

/**
 * Rutas para la gestión de tareas.
 * Permiten la creación, edición, eliminación y actualización del estado de las tareas.
 */
Route::prefix('tasks')->group(function () {
    /**
     * Lista todas las tareas disponibles.
     */
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');

    /**
     * Almacena una nueva tarea en la base de datos.
     */
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');

    /**
     * Muestra el formulario para editar una tarea existente.
     * 
     * @param int $task ID de la tarea a editar.
     */
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    /**
     * Actualiza los datos de una tarea existente.
     * 
     * @param int $task ID de la tarea a actualizar.
     */
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');

    /**
     * Elimina una tarea de la base de datos.
     * 
     * @param int $task ID de la tarea a eliminar.
     */
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    /**
     * Alterna el estado de una tarea (completada o pendiente).
     * 
     * @param int $task ID de la tarea a cambiar de estado.
     */
    Route::put('/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    /**
     * Descarga un archivo adjunto a una tarea.
     * 
     * @param int $task ID de la tarea con el archivo a descargar.
     */
    Route::get('/{task}/download', [TaskController::class, 'downloadFile'])->name('tasks.download');
});
