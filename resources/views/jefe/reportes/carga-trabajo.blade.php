@extends('layouts.app')


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Carga de Trabajo</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 40px 20px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    h2 {
      text-align: center;
      font-size: 24px;
      color: #1f2937;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    thead {
      background-color: #343a40;
      color: #ffffff;
    }

    th, td {
      padding: 12px 16px;
      text-align: center;
      border: 1px solid #dee2e6;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a.btn {
      display: inline-block;
      margin-top: 30px;
      padding: 10px 20px;
      text-decoration: none;
      background-color: #6c757d;
      color: white;
      border-radius: 6px;
      text-align: center;
      font-weight: bold;
    }

    a.btn:hover {
      background-color: #5a6268;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      td {
        padding: 10px;
        border: none;
        position: relative;
        padding-left: 50%;
        margin-bottom: 12px;
      }

      td::before {
        position: absolute;
        top: 10px;
        left: 10px;
        font-weight: bold;
        white-space: nowrap;
      }

      td:nth-of-type(1)::before { content: "Usuario"; }
      td:nth-of-type(2)::before { content: "Total"; }
      td:nth-of-type(3)::before { content: "Pendientes"; }
      td:nth-of-type(4)::before { content: "En Progreso"; }
      td:nth-of-type(5)::before { content: "Finalizadas"; }
    }
  </style>
</head>
<body>

<div class="container">
  <h2>📌 Carga de Trabajo por Usuario</h2>

  <table>
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Total</th>
        <th>Pendientes</th>
        <th>En Progreso</th>
        <th>Finalizadas</th>
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

  <a href="{{ route('reportes.index') }}" class="btn">⬅ Volver</a>
</div>

</body>
</html>
