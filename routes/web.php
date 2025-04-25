<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UserManagementController;



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

use App\Http\Controllers\AdminDashboardController;
/**
 * Rutas de autenticación para administradores
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthAdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthAdminController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthAdminController::class, 'logout'])->name('logout');

    // Registro de administradores
    Route::get('register', [AuthAdminController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthAdminController::class, 'register'])->name('register.submit');

    // Rutas protegidas para administradores
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('edit', [AdminDashboardController::class, 'edit'])->name('edit');
        Route::put('update', [AdminDashboardController::class, 'update'])->name('update');
        Route::delete('delete', [AdminDashboardController::class, 'destroy'])->name('destroy');
    });
});
/**
 * Rutas para la gestión de usuarios
 * 
 * - Muestra la lista de usuarios.
 * - Muestra el formulario de edición de un usuario específico.
 * - Actualiza la información de un usuario.
 * - Elimina un usuario.
 */
Route::middleware('auth:admin')->group(function () {
    // Lista de usuarios
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');

    // CRUD de usuarios
    Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.delete');

    // Asignación de tareas
    Route::get('/users/{id}/assign-task', [UserManagementController::class, 'assignTaskForm'])->name('users.assign-task');
    Route::post('/users/{id}/assign-task', [UserManagementController::class, 'assignTask'])->name('users.assign-task.store');
});
/**
 * Rutas para la asignación de tareas a usuarios
 * 
 * - Muestra el formulario para asignar una tarea a un usuario.
 * - Procesa la asignación de una tarea al usuario.
 */
Route::middleware('auth:admin')->group(function () {
    Route::get('/users/{id}/assign-task', [UserManagementController::class, 'assignTaskForm'])->name('users.assign-task');
    Route::post('/users/{id}/assign-task', [UserManagementController::class, 'assignTask'])->name('users.assign-task.store');
});