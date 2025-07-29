<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subtarea extends Model
{
    use HasFactory;

    protected $table = 'subtareas';

    protected $fillable = ['id_tarea', 'titulo', 'estado'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'id_tarea');
    }
}

