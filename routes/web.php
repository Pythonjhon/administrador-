<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas para tareas agrupadas
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::put('/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});