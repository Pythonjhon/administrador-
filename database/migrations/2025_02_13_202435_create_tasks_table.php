<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade'); // Relación con usuarios
            $table->boolean('completed')->default(false);
            $table->string('image')->nullable(); // Campo para imagen
            $table->string('archivo')->nullable(); // Nuevo campo para archivos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
