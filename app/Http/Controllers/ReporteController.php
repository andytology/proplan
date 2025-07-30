<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Página central de reportes
     */
    public function index()
    {
        return view('jefe.reportes.index');
    }

    /**
     * Reporte T07.1 – Carga de trabajo por usuario
     */
    public function cargaTrabajo()
    {
        $usuarios = DB::table('usuarios')
            ->leftJoin('tareas', 'usuarios.id', '=', 'tareas.id_usuario')
            ->select(
                'usuarios.nombre',
                DB::raw('COUNT(tareas.id) AS total_tareas'),
                DB::raw("SUM(CASE WHEN tareas.estado = 'Pendiente' THEN 1 ELSE 0 END) AS tareas_pendientes"),
                DB::raw("SUM(CASE WHEN tareas.estado = 'En progreso' THEN 1 ELSE 0 END) AS tareas_en_progreso"),
                DB::raw("SUM(CASE WHEN tareas.estado = 'Completado' THEN 1 ELSE 0 END) AS tareas_completadas")
            )
            ->groupBy('usuarios.id', 'usuarios.nombre')
            ->orderBy('usuarios.nombre')
            ->get();

        return view('jefe.reportes.carga-trabajo', compact('usuarios'));
    }

    /**
     * Reporte T07.2 – Estado del proyecto (Semáforo de tareas y subtareas por proyecto)
     */
    public function semaforo()
{
    $proyectos = DB::table('proyectos')->get();
    $resultados = [];
    $detalleProyectos = [];

    foreach ($proyectos as $proyecto) {
        $tareas = DB::table('tareas')->where('id_proyecto', $proyecto->id)->get();

        $totalTareas = $tareas->count();
        $tareasCompletadas = $tareas->where('estado', 'Completado')->count();

        $totalSubtareas = 0;
        $subtareasCompletadas = 0;

        $tareasDetalladas = [];

        foreach ($tareas as $tarea) {
            $subtareas = DB::table('subtareas')->where('id_tarea', $tarea->id)->get();

            $totalSubtareas += $subtareas->count();
            $subtareasCompletadas += $subtareas->where('estado', 'Completado')->count();

            $avanceTarea = $subtareas->count() > 0 
                ? round(($subtareas->where('estado', 'Completado')->count() / $subtareas->count()) * 100, 2)
                : ($tarea->estado === 'Completado' ? 100 : 0);

            $estadoTarea = $this->calcularSemaforo($avanceTarea);

            $tareasDetalladas[] = [
                'tarea' => $tarea,
                'subtareas' => $subtareas,
                'avance' => $avanceTarea,
                'estado' => $estadoTarea
            ];
        }

        $totalActividades = $totalTareas + $totalSubtareas;
        $totalFinalizadas = $tareasCompletadas + $subtareasCompletadas;

        $porcentaje = $totalActividades > 0
            ? round(($totalFinalizadas / $totalActividades) * 100, 2)
            : 0;

        $estado = $this->calcularSemaforo($porcentaje);

        $resultados[] = [
            'nombre_proyecto' => $proyecto->nombre,
            'total_tareas' => $totalTareas,
            'total_subtareas' => $totalSubtareas,
            'completadas' => $totalFinalizadas,
            'avance' => $porcentaje,
            'estado' => $estado,
        ];

        $detalleProyectos[] = [
            'proyecto' => $proyecto,
            'tareas_detalladas' => $tareasDetalladas
        ];
        
    }

    return view('jefe.reportes.semaforo', [
        'proyectos' => $resultados,
        'detalle_proyectos' => $detalleProyectos,
        'resumen_tareas' => $this->resumenTareas(),
        'resumen_subtareas' => $this->resumenSubtareas()
    ]);
}
private function calcularSemaforo($porcentaje)
    {
        if ($porcentaje >= 80) return 'Verde';
        if ($porcentaje >= 50) return 'Amarillo';
        return 'Rojo';
    }
    /**
 * Semáforo general de tareas
 */
private function resumenTareas()
{
    $total = DB::table('tareas')->count();
    $completadas = DB::table('tareas')->where('estado', 'Completado')->count();
    $en_progreso = DB::table('tareas')->where('estado', 'En progreso')->count();
    $pendientes = DB::table('tareas')->where('estado', 'Pendiente')->count();

    $avance = $total > 0 ? round(($completadas / $total) * 100, 2) : 0;

    return [
        'tipo' => 'Tareas',
        'total' => $total,
        'completadas' => $completadas,
        'en_progreso' => $en_progreso,
        'pendientes' => $pendientes,
        'avance' => $avance,
        'estado' => $this->calcularSemaforo($avance)
    ];
}
/**
 * Semáforo general de subtareas
 */
private function resumenSubtareas()
{
    $total = DB::table('subtareas')->count();
    $completadas = DB::table('subtareas')->where('estado', 'Completado')->count();
    $en_progreso = DB::table('subtareas')->where('estado', 'En progreso')->count();
    $pendientes = DB::table('subtareas')->where('estado', 'Pendiente')->count();

    $avance = $total > 0 ? round(($completadas / $total) * 100, 2) : 0;

    return [
        'tipo' => 'Subtareas',
        'total' => $total,
        'completadas' => $completadas,
        'en_progreso' => $en_progreso,
        'pendientes' => $pendientes,
        'avance' => $avance,
        'estado' => $this->calcularSemaforo($avance)
    ];
}

}
