@extends('layouts.app')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Jefe de Proyecto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  {{-- Contenedor principal --}}
  <div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Caja de bienvenida --}}
    <div class="bg-white shadow-md rounded-lg p-6">
      <h1 class="text-3xl font-bold mb-2">¡Hola, {{ auth()->user()->nombre }}!</h1>
      <p class="text-lg">
        Tu rol es: <span class="font-semibold text-blue-600">{{ auth()->user()->rol }}</span>
      </p>
    </div>

    {{-- Botón de nueva tarea --}}
    <div class="text-right">
      <a href="{{ route('tareas.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
        + Nueva Tarea
      </a>
    </div>

    {{-- Tabla de tareas --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full table-auto">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
          <tr>
            <th class="px-4 py-3 text-left">Título</th>
            <th class="px-4 py-3 text-left">Descripción</th>
            <th class="px-4 py-3 text-left">Proyecto</th>
            <th class="px-4 py-3 text-left">Responsable</th>
            <th class="px-4 py-3 text-left">Estado</th>
            <th class="px-4 py-3 text-left">Prioridad</th>
            <th class="px-4 py-3 text-left">Inicio</th>
            <th class="px-4 py-3 text-left">Fin</th>
            <th class="px-4 py-3 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-200">
          @forelse ($tareas as $tarea)
            <tr>
              <td class="px-4 py-2">{{ $tarea->titulo }}</td>
              <td class="px-4 py-2">{{ $tarea->descripcion }}</td>
              <td class="px-4 py-2">{{ $tarea->proyecto->nombre ?? 'N/A' }}</td>
              <td class="px-4 py-2">{{ $tarea->usuario->nombre ?? 'No asignado' }}</td>
              <td class="px-4 py-2">
                <span class="px-2 py-1 rounded-full text-xs font-semibold
                  {{ $tarea->estado === 'Completado' ? 'bg-green-100 text-green-800' :
                     ($tarea->estado === 'En progreso' ? 'bg-yellow-100 text-yellow-800' :
                     'bg-gray-100 text-gray-800') }}">
                  {{ $tarea->estado }}
                </span>
              </td>
              <td class="px-4 py-2">
                <span class="font-medium
                  {{ $tarea->prioridad === 'Alta' ? 'text-red-600' :
                     ($tarea->prioridad === 'Media' ? 'text-yellow-600' :
                     'text-green-600') }}">
                  {{ $tarea->prioridad }}
                </span>
              </td>
              <td class="px-4 py-2">{{ $tarea->fecha_inicio }}</td>
              <td class="px-4 py-2">{{ $tarea->fecha_fin }}</td>
              <td class="px-4 py-2 text-right">
                <a href="{{ route('tareas.edit', $tarea->id) }}" class="text-blue-600 hover:underline mr-3">Editar</a>
                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar esta tarea?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="px-4 py-4 text-center text-gray-500">No hay tareas registradas.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-8">
      <p><a href="/" class="text-blue-500 hover:underline">PROPLAN</a></p>
      <p>{{ auth()->user()->nombre }}</p>
      <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button class="text-sm text-red-600 hover:underline" type="submit">Cerrar sesión</button>
      </form>
      <p class="mt-4">© 2025 PROPLAN. Todos los derechos reservados.</p>
    </footer>

  </div>
</body>
</html>


