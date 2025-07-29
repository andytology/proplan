{{-- resources/views/usuario/dashboard-simple.blade.php --}}
@extends('layouts.app')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 40px 20px;
    }

    .dashboard-container {
      max-width: 500px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .dashboard-container h1 {
      font-size: 24px;
      font-weight: 600;
      color: #111827;
      margin-bottom: 16px;
    }

    .dashboard-container p {
      font-size: 18px;
      color: #374151;
    }

    .dashboard-container span {
      font-weight: bold;
      color: #059669;
    }
  </style>
</head>
<body>

<div class="dashboard-container">
  <h1>¡Hola, {{ auth()->user()->nombre }}!</h1>
  <p>Tu rol es: <span>{{ auth()->user()->rol }}</span></p>
</div>

</body>
</html>

    

       