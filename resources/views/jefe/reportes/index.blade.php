@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Carga de Trabajo</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
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

    h1 {
      text-align: center;
      font-size: 28px;
      color: #1f2937;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    thead {
      background-color: #f1f5f9;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #e2e8f0;
    }

    th {
      font-size: 14px;
      color: #6b7280;
      text-transform: uppercase;
    }

    td {
      font-size: 15px;
      color: #374151;
    }

    .badge {
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: bold;
      display: inline-block;
    }

    .pendiente {
      background-color: #fef3c7;
      color: #92400e;
    }

    .en-progreso {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .finalizada {
      background-color: #d1fae5;
      color: #065f46;
    }

    .footer {
      text-align: center;
      font-size: 13px;
      color: #9ca3af;
      margin-top: 40px;
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
        margin-bottom: 10px;
      }

      td::before {
        position: absolute;
        top: 10px;
        left: 10px;
        font-weight: bold;
        white-space: nowrap;
      }

      td:nth-of-type(1)::before { content: "Nombre"; }
      td:nth-of-type(2)::before { content: "Total tareas"; }
      td:nth-of-type(3)::before { content: "Pendientes"; }
      td:nth-of-type(4)::before { content: "En progreso"; }
      td:nth-of-type(5)::before { content: "Finalizadas"; }
    }
  </style>
</head>
<body>


@section('title', 'Centro de Reportes')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">📊 Centro de Reportes</h2>

    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="{{ route('reportes.carga') }}" class="btn btn-outline-primary btn-lg w-100">
                📌 Reporte de Carga de Trabajo
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('reportes.semaforo') }}" class="btn btn-outline-danger btn-lg w-100">
                🚦 Reporte Semáforo de Proyecto
            </a>
        </div>
    </div>
</div>
@endsection

</body>
</html>

