<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id_tarea';
    protected $fillable = [
        'id_proyecto', 'titulo', 'descripcion',
        'fecha_inicio', 'fecha_fin', 'estado',
        'prioridad', 'id_usuario'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function subtareas()
    {
        return $this->hasMany(Subtarea::class, 'id_tarea');
    }

    public function presupuesto()
    {
        return $this->hasOne(Presupuesto::class, 'id_tarea');
    }
}
