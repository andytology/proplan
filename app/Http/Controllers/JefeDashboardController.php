<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class JefeDashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Supongamos que un jefe ve todos los proyectos
        $proyectos = Proyecto::all();

        // O si cada proyecto tiene un jefe:
        // $proyectos = Proyecto::where('id_jefe', $usuario->id)->get();

        // Tareas del jefe o su equipo (por ahora todas para testear)
        $tareas = Tarea::all();

        $totalTareas = $tareas->count();

        return view('jefe.dashboard', compact('usuario', 'proyectos', 'tareas', 'totalTareas'));
    }
}
