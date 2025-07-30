@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Semáforo de Proyectos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        h2, h3, h5 {
            text-align: center;
            color: #1f2937;
            margin-bottom: 20px;
        }

        h5 {
            text-align: left;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 16px;
            text-align: center;
            border: 1px solid #d1d5db;
        }

        thead {
            background-color: #1f2937;
            color: #ffffff;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            color: white;
        }

        .bg-success { background-color: #198754 !important; }
        .bg-warning { background-color: #ffc107 !important; color: #111 !important; }
        .bg-danger  { background-color: #dc3545 !important; }

        .progress {
            background-color: #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            height: 20px;
            width: 100%;
        }

        .progress-bar {
            height: 100%;
            text-align: center;
            color: white;
            font-weight: bold;
        }

        .list-group { list-style: none; padding-left: 0; }
        .list-group-item {
            background-color: #f9fafb;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        ul ul {
            list-style-type: circle;
            padding-left: 20px;
        }

        a.btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            text-decoration: none;
            border: 2px solid #6c757d;
            color: #6c757d;
            border-radius: 8px;
            font-weight: bold;
        }

        a.btn:hover {
            background-color: #6c757d;
            color: #fff;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-primary { color: #0d6efd; }
        .text-info    { color: #0dcaf0; }

        .fs-6 { font-size: 16px; }
        .fw-bold { font-weight: bold; }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                margin-bottom: 10px;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                top: 12px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h2>🚦 Estado de Proyectos (Tareas + Subtareas)</h2>

    @if(count($proyectos) > 0)
    <table>
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Tareas</th>
                <th>Subtareas</th>
                <th>Total Actividades</th>
                <th>Completadas</th>
                <th>Avance (%)</th>
                <th>Barra</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $p)
            @php
                $totalActividades = $p['total_tareas'] + $p['total_subtareas'];
            @endphp
            <tr>
                <td><strong>{{ $p['nombre_proyecto'] }}</strong></td>
                <td>{{ $p['total_tareas'] }}</td>
                <td>{{ $p['total_subtareas'] }}</td>
                <td>{{ $totalActividades }}</td>
                <td>{{ $p['completadas'] }}</td>
                <td class="fw-bold">{{ $p['avance'] }}%</td>
                <td>
                    <div class="progress">
                        <div class="progress-bar 
                            @if($p['estado'] == 'Verde') bg-success
                            @elseif($p['estado'] == 'Amarillo') bg-warning
                            @else bg-danger @endif"
    >
                            {{ $p['avance'] }}%
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge fs-6
                        @if($p['estado'] == 'Verde') bg-success
                        @elseif($p['estado'] == 'Amarillo') bg-warning
                        @else bg-danger @endif">
                        {{ $p['estado'] == 'Verde' ? '🟢 Verde' : ($p['estado'] == 'Amarillo' ? '🟡 Amarillo' : '🔴 Rojo') }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-center text-muted">No hay proyectos registrados para mostrar.</p>
    @endif

    <hr>

    <h3>📋 Resumen General de Tareas y Subtareas</h3>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Total</th>
                <th>Completadas</th>
                <th>En Progreso</th>
                <th>Pendientes</th>
                <th>Avance (%)</th>
                <th>Estado</th>
                <th>Barra</th>
            </tr>
        </thead>
        <tbody>
            @foreach([$resumen_tareas, $resumen_subtareas] as $r)
            <tr>
                <td class="fw-bold">{{ $r['tipo'] }}</td>
                <td>{{ $r['total'] }}</td>
                <td>{{ $r['completadas'] }}</td>
                <td>{{ $r['en_progreso'] }}</td>
                <td>{{ $r['pendientes'] }}</td>
                <td class="fw-bold">{{ $r['avance'] }}%</td>
                <td>
                    <span class="badge fs-6
                        @if($r['estado'] == 'Verde') bg-success
                        @elseif($r['estado'] == 'Amarillo') bg-warning
                        @else bg-danger @endif">
                        {{ $r['estado'] == 'Verde' ? '🟢 Verde' : ($r['estado'] == 'Amarillo' ? '🟡 Amarillo' : '🔴 Rojo') }}
                    </span>
                </td>
                <td>
                    <div class="progress">
                        <div class="progress-bar 
                            @if($r['estado'] == 'Verde') bg-success
                            @elseif($r['estado'] == 'Amarillo') bg-warning
                            @else bg-danger @endif"
                            >
                            {{ $r['avance'] }}%
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-primary">📋 Detalle de Tareas y Subtareas por Proyecto</h3>

    @foreach($detalle_proyectos as $grupo)
    <div class="mt-4">
        <h5 class="text-info">📁 {{ $grupo['proyecto']->nombre }}</h5>
        <ul class="list-group">
            @foreach($grupo['tareas_detalladas'] as $t)
            <li class="list-group-item">
                <strong>▶ {{ $t['tarea']->titulo }}</strong> ({{ $t['estado'] }} - {{ $t['avance'] }}%)
                @if(count($t['subtareas']) > 0)
                <ul class="mt-2">
                    @foreach($t['subtareas'] as $sub)
                    <li>
                        ▸ {{ $sub->titulo }} -
                        <span class="badge
                            @if($sub->estado == 'Completado') bg-success
                            @elseif($sub->estado == 'En progreso') bg-warning
                            @else bg-danger @endif">
                            {{ $sub->estado }}
                        </span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-muted small">Sin subtareas registradas.</p>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endforeach

    <div class="text-center mt-5">
        <a href="{{ route('reportes.index') }}" class="btn">⬅ Volver al Centro de Reportes</a>
    </div>

    <p class="text-center text-muted mt-4">© 2025 PROPLAN. Todos los derechos reservados.</p>

</div>

</body>
</html>

