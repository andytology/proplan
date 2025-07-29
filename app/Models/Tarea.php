<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'id_proyecto', 'titulo', 'descripcion',
        'fecha_inicio', 'fecha_fin', 'estado',
        'prioridad', 'id_usuario'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function subtareas()
    {
        return $this->hasMany(Subtarea::class, 'id_tarea');
    }
}
