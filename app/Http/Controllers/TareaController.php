<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Subtarea;
use App\Models\Proyecto;
use App\Models\Usuario;

class TareaController extends Controller
{
    /**
     * Mostrar todas las tareas con sus relaciones.
     * Usado para jefe de proyecto en su dashboard.
     */
    public function index()
    {
        $tareas = Tarea::with(['subtareas', 'usuario', 'proyecto'])->get();
        $proyectos = Proyecto::all();
        $usuarios = Usuario::all();

        return view('jefe.dashboard', compact('tareas', 'proyectos', 'usuarios'));
    }

    /**
     * Guardar una nueva tarea con subtareas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:255',
            'prioridad' => 'required|string|max:255',
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_usuario' => 'nullable|exists:usuarios,id',
            'subtareas' => 'array',
            'subtareas.*' => 'nullable|string|max:255',
        ]);

        $tarea = Tarea::create($request->only([
            'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin',
            'estado', 'prioridad', 'id_proyecto', 'id_usuario'
        ]));

        if ($request->filled('subtareas')) {
            foreach ($request->subtareas as $subtitulo) {
                if (!empty($subtitulo)) {
                    Subtarea::create([
                        'id_tarea' => $tarea->id,
                        'titulo' => $subtitulo,
                        'estado' => 'Pendiente',
                    ]);
                }
            }
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $tarea = Tarea::with('subtareas')->findOrFail($id);
        $proyectos = Proyecto::all();
        $usuarios = Usuario::all();

        return view('jefe.dashboard', compact('tarea', 'proyectos', 'usuarios'));
    }

    /**
     * Actualizar una tarea existente y sus subtareas.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:255',
            'prioridad' => 'required|string|max:255',
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_usuario' => 'nullable|exists:usuarios,id',
            'subtareas' => 'array',
            'subtareas.*' => 'nullable|string|max:255',
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->only([
            'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin',
            'estado', 'prioridad', 'id_proyecto', 'id_usuario'
        ]));

        // Eliminar subtareas existentes y recrearlas
        Subtarea::where('id_tarea', $tarea->id)->delete();

        if ($request->filled('subtareas')) {
            foreach ($request->subtareas as $subtitulo) {
                if (!empty($subtitulo)) {
                    Subtarea::create([
                        'id_tarea' => $tarea->id,
                        'titulo' => $subtitulo,
                        'estado' => 'Pendiente',
                    ]);
                }
            }
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Eliminar una tarea y sus subtareas.
     */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->subtareas()->delete();
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
}

