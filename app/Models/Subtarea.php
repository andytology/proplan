<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarea extends Model
{
    protected $table = 'subtareas';
    protected $primaryKey = 'id_subtarea';
    protected $fillable = ['id_tarea', 'titulo', 'estado'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'id_tarea');
    }
}
