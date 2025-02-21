<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para agregar la columna 'assigned_to' a la tabla 'tasks'.
     */
    public function up(){
        Schema::table('tasks', function (Blueprint $table) {
            // Agrega una columna 'assigned_to' de tipo unsignedBigInteger que puede ser nula
            $table->unsignedBigInteger('assigned_to')->nullable()->after('description');
            
            // Crea una clave foránea que referencia la columna 'id' de la tabla 'users'
            // Si el usuario es eliminado, el campo 'assigned_to' se establece en NULL
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Revierte los cambios realizados en la migración.
     */
    public function down(){
        Schema::table('tasks', function (Blueprint $table) {
            // Elimina la clave foránea de 'assigned_to'
            $table->dropForeign(['assigned_to']);
            
            // Elimina la columna 'assigned_to' de la tabla 'tasks'
            $table->dropColumn('assigned_to');
        });
    }
};
