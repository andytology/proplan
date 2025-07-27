<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';
    protected $primaryKey = 'id_presupuesto';
    protected $fillable = ['id_tarea', 'monto_estimado', 'costo_ejecutado'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'id_tarea');
    }

    public function calcularDiferencia()
    {
        return $this->monto_estimado - $this->costo_ejecutado;
    }
}
