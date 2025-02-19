<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [DashboardController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [DashboardController::class, 'destroy'])->name('profile.delete');
});

// Rutas para tareas
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::put('/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::get('/tasks/{task}/download', [TaskController::class, 'downloadFile'])->name('tasks.download');

});
