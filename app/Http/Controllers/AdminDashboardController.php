<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Proyecto;

class AdminDashboardController extends Controller
{
    

    /**
     * Mostrar el panel de administrador con usuarios y proyectos.
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::all();
        $proyectos = Proyecto::all();

        return view('admin.dashboard', compact('usuarios', 'proyectos'));
    }

    /**
     * Almacenar un nuevo proyecto.
     */
    public function storeProyecto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:255',
        ]);

        Proyecto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Proyecto creado correctamente.');
    }

    /**
     * Actualizar un proyecto existente.
     */
    public function updateProyecto(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:255',
        ]);

        $proyecto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Eliminar un proyecto.
     */
    public function destroyProyecto(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Proyecto eliminado correctamente.');
    }
}

