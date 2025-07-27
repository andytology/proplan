<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['nombre', 'email', 'contraseña', 'rol'];

    public function tareasAsignadas()
    {
        return $this->hasMany(Tarea::class, 'id_usuario');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'id_usuario');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'asignaciones', 'id_usuario', 'id_proyecto')
                    ->withPivot('rol_en_proyecto');
    }
}
