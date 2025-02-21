<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para agregar la columna 'file_path' a la tabla 'tasks'.
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Agrega una columna 'file_path' de tipo string que puede ser nula
            // Se usará para almacenar la ruta de un archivo asociado a la tarea
            $table->string('file_path')->nullable()->after('description');
        });
    }

    /**
     * Revierte los cambios realizados en la migración.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Elimina la columna 'file_path' de la tabla 'tasks'
            $table->dropColumn('file_path');
        });
    }
};
