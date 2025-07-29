<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class UsuarioDashboardController extends Controller
{
    /**
     * Muestra el panel del usuario con sus tareas y subtareas.
     */
    public function __invoke()
    {
        $usuario = auth()->user();

        // Carga las tareas del usuario con sus subtareas (si usas eager loading)
        $tareas = Tarea::with('subtareas', 'proyecto') // puedes incluir 'proyecto' si necesitas el nombre
                        ->where('id_usuario', $usuario->id)
                        ->get();

        return view('usuario.dashboard', compact('usuario', 'tareas'));
    }
}
