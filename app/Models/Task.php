<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Task que representa una tarea en la base de datos.
 */
class Task extends Model
{
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'completed', 'image', 'assigned_to', 'archivo'];
    /**
     * Relación: una tarea pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
