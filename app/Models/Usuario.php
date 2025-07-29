<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';       
    public    $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'rol',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    // Dile a Auth que la columna de password es `contraseña`
    public function getAuthPassword()
    {
        return $this->attributes['contraseña'];
    }

    // Constantes de rol para no repetir strings
    public const ROLE_ADMIN = 'Administrador';
    public const ROLE_JEFE  = 'Jefe de Proyecto';
    public const ROLE_USER  = 'Usuario';
}

