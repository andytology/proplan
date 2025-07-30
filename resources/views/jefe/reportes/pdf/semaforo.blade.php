<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Semáforo de Proyectos</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2, h3, h4 { margin-top: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background-color: #f0f0f0; }
    .estado-verde { color: green; font-weight: bold; }
    .estado-amarillo { color: orange; font-weight: bold; }
    .estado-rojo { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <h2>📊 Reporte Semáforo de Proyectos</h2>

  <table>
    <thead>
      <tr>
        <th>Proyecto</th>
        <th>Tareas</th>
        <th>Subtareas</th>
        <th>Completadas</th>
        <th>Avance</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      @foreach($proyectos as $p)
      <tr>
        <td>{{ $p->nombre_proyecto }}</td>
        <td>{{ $p->total_tareas }}</td>
        <td>{{ $p->total_subtareas }}</td>
        <td>{{ $p->completadas }}</td>
        <td>{{ $p->avance }}%</td>
        <td class="
          @if($p->estado == 'Verde') estado-verde
          @elseif($p->estado == 'Amarillo') estado-amarillo
          @else estado-rojo
          @endif">
          {{ $p->estado }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <h3>📂 Detalle por Proyecto</h3>
  @foreach($detalleProyectos as $grupo)
    <h4>📁 {{ $grupo['proyecto']->nombre }}</h4>

    @foreach($grupo['tareas_detalladas'] as $item)
      <p><strong>▶ Tarea:</strong> {{ $item['tarea']->titulo }} 
        ({{ $item['avance'] }}% - Estado: {{ $item['estado'] }})</p>

      @if(count($item['subtareas']) > 0)
        <ul>
          @foreach($item['subtareas'] as $s)
            <li>{{ $s->titulo }} - Estado: {{ $s->estado }}</li>
          @endforeach
        </ul>
      @else
        <p><em>Sin subtareas registradas.</em></p>
      @endif
    @endforeach
    <hr>
  @endforeach

  <p style="text-align: right; margin-top: 30px;">
    Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
  </p>
</body>
</html>
