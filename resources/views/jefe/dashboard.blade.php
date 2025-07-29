{{-- resources/views/jefe/dashboard-simple.blade.php --}}
@extends('layouts.app')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Jefe de Proyecto</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f3f4f6;
      margin: 0;
      padding: 40px 20px;
    }

    .dashboard-box {
      max-width: 500px;
      margin: auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .dashboard-box h1 {
      font-size: 24px;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 16px;
    }

    .dashboard-box p {
      font-size: 18px;
      color: #374151;
    }

    .dashboard-box span {
      font-weight: bold;
      color: #1d4ed8;
    }
  </style>
</head>
<body>

<div class="dashboard-box">
  <h1>¡Hola, {{ auth()->user()->nombre }}!</h1>
  <p>Tu rol es: <span>{{ auth()->user()->rol }}</span></p>
</div>

</body>
</html>

