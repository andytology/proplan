@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .flash-message {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .header {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 26px;
            color: #1f2937;
            margin: 0;
        }

        .header p {
            color: #6b7280;
            margin-top: 8px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            min-width: 200px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .card h3 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
        }

        .search-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-top: 40px;
        }

        .search-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-header h2 {
            font-size: 20px;
            color: #1f2937;
            margin: 0;
        }

        .search-header input {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            width: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #f9fafb;
        }

        table th, table td {
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }

        table th {
            color: #6b7280;
            text-transform: uppercase;
        }

        table tbody tr {
            border-top: 1px solid #e5e7eb;
        }

        .actions {
            text-align: right;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            padding: 6px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
        }

        .text-blue-600 { color: #2563eb; }
        .text-red-600 { color: #dc2626; }
        .bg-green-600 { background-color: #16a34a; }

        @media (max-width: 768px) {
            .cards { flex-direction: column; }
            .search-header { flex-direction: column; align-items: flex-start; }
            .search-header input { width: 100%; }
        }
    </style>
</head>
<body>
<div class="container">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="header">
        <h1>Dashboard de Administrador</h1>
        <p>¡Hola, {{ auth()->user()->nombre }}!</p>
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="cards">
        <div class="card">
            <h3>Usuarios</h3>
            <p>{{ $usuarios->count() }}</p>
        </div>
        <div class="card">
            <h3>Proyectos</h3>
            <p>{{ $proyectos->count() }}</p>
        </div>
        <div class="card">
            <h3>Tareas</h3>
            <p>--</p> {{-- Puedes mostrar el conteo cuando tengas tareas --}}
        </div>
    </div>

    {{-- Tabla de usuarios --}}
    <div class="search-section">
        <div class="search-header">
            <h2>Usuarios registrados</h2>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar usuario...">
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="actions">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->rol }}</td>
                            <td class="actions">
                                {{-- Acción futura (ver, editar, eliminar usuarios) --}}
                                <a href="#" class="text-blue-600">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Crear nuevo proyecto --}}
    <div class="search-section">
        <div class="search-header">
            <h2>Crear nuevo proyecto</h2>
        </div>
        <form method="POST" action="{{ route('admin.proyectos.store') }}">
            @csrf

            <label>Nombre del Proyecto</label><br>
            <input type="text" name="nombre" required class="w-full border rounded p-2 mb-4"><br>

            <label>Descripción</label><br>
            <textarea name="descripcion" class="w-full border rounded p-2 mb-4"></textarea><br>

            <label>Fecha de Inicio</label><br>
            <input type="date" name="fecha_inicio" required class="w-full border rounded p-2 mb-4"><br>

            <label>Fecha de Fin</label><br>
            <input type="date" name="fecha_fin" required class="w-full border rounded p-2 mb-4"><br>

            <label>Estado</label><br>
            <select name="estado" class="w-full border rounded p-2 mb-4">
                <option value="Activo">Activo</option>
                <option value="En Progreso">En Progreso</option>
                <option value="Finalizado">Finalizado</option>
            </select><br>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 mt-2">Guardar Proyecto</button>
        </form>
    </div>

    {{-- Listado de proyectos --}}
    <div class="search-section">
        <div class="search-header">
            <h2>Proyectos existentes</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Estado</th>
                    <th colspan="2" class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <form action="{{ route('admin.proyectos.update', $proyecto) }}" method="POST">
                            @csrf @method('PUT')
                            <td><input type="text" name="nombre" value="{{ $proyecto->nombre }}" required></td>
                            <td><input type="text" name="descripcion" value="{{ $proyecto->descripcion }}"></td>
                            <td><input type="date" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" required></td>
                            <td><input type="date" name="fecha_fin" value="{{ $proyecto->fecha_fin }}" required></td>
                            <td>
                                <select name="estado">
                                    <option value="Activo" {{ $proyecto->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="En Progreso" {{ $proyecto->estado == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                    <option value="Finalizado" {{ $proyecto->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="text-blue-600">Actualizar</button>
                            </td>
                        </form>
                        <td>
                            <form action="{{ route('admin.proyectos.destroy', $proyecto) }}" method="POST" onsubmit="return confirm('¿Eliminar este proyecto?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
@endsection
