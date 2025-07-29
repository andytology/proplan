<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'id');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id');
    }

    public function equipo()
    {
        return $this->belongsToMany(Usuario::class, 'asignaciones', 'id_proyecto', 'id_usuario')
                    ->withPivot('rol_en_proyecto');
    }
}
