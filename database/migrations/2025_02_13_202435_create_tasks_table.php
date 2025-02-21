<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la creación de la tabla "tasks".
 */
return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Identificador único para la tarea
            $table->string('title'); // Título de la tarea
            $table->text('description')->nullable(); // Descripción opcional de la tarea
            
            // Relación con usuarios (comentada, pero puede activarse si se necesita)
            // $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade'); 

            $table->boolean('completed')->default(false); // Estado de la tarea (completada o no)
            $table->string('image')->nullable(); // Ruta de la imagen asociada (opcional)
            $table->string('archivo')->nullable(); // Ruta del archivo adjunto (opcional)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Revierte la migración.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks'); // Elimina la tabla si existe
    }
};
