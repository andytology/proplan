<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Carga de Trabajo</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>📌 Reporte de Carga de Trabajo por Usuario</h2>

    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Total Tareas</th>
                <th>Pendientes</th>
                <th>En Progreso</th>
                <th>Completadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->nombre }}</td>
                <td>{{ $u->total_tareas }}</td>
                <td>{{ $u->tareas_pendientes }}</td>
                <td>{{ $u->tareas_en_progreso }}</td>
                <td>{{ $u->tareas_completadas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 40px;">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </p>
    <div class="text-center my-4">
    <a href="{{ route('reportes.carga.pdf') }}" class="btn btn-outline-danger me-2">
        📥 Descargar PDF de Carga de Trabajo
    </a>
    <div></div>
</body>
</html>
