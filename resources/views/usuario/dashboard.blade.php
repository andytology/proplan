@extends('layouts.app')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Usuario</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="max-w-5xl mx-auto p-6">

    {{-- Encabezado de bienvenida --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Dashboard de Usuario</h1>
      <p class="text-lg text-gray-600 mt-2">¡Bienvenido, {{ $usuario->nombre }}!</p>
    </div>

    {{-- Tareas asignadas --}}
    <div class="space-y-6">
      <h2 class="text-2xl font-semibold text-gray-800">Tus tareas asignadas:</h2>

      @forelse($tareas as $tarea)
        <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-sm hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-blue-700">{{ $tarea->titulo }}</h3>
            <span class="text-sm px-3 py-1 rounded-full 
              {{ $tarea->estado === 'Completado' ? 'bg-green-100 text-green-800' : 
                 ($tarea->estado === 'En progreso' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
              {{ $tarea->estado }}
            </span>
          </div>
          <p class="text-gray-700 mt-1">{{ $tarea->descripcion }}</p>
          <p class="text-sm text-gray-600 mt-2">
            <strong>Prioridad:</strong> 
            <span class="
              {{ $tarea->prioridad === 'Alta' ? 'text-red-600 font-semibold' : 
                 ($tarea->prioridad === 'Media' ? 'text-yellow-600 font-medium' : 'text-green-600') }}">
              {{ $tarea->prioridad }}
            </span>
          </p>

          {{-- Subtareas --}}
          @if ($tarea->subtareas->count())
            <div class="mt-4">
              <h4 class="text-md font-semibold text-gray-800 mb-1">Subtareas:</h4>
              <ul class="list-disc ml-6 text-sm text-gray-700 space-y-1">
                @foreach($tarea->subtareas as $subtarea)
                  <li>
                    <span class="font-semibold">{{ $subtarea->titulo }}</span> - {{ $subtarea->descripcion }}
                    <span class="ml-2 text-xs px-2 py-0.5 rounded 
                      {{ $subtarea->estado === 'Completado' ? 'bg-green-100 text-green-800' : 
                         ($subtarea->estado === 'En progreso' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-200 text-gray-700') }}">
                      {{ $subtarea->estado }}
                    </span>
                  </li>
                @endforeach
              </ul>
            </div>
          @else
            <p class="text-sm text-gray-500 mt-2">No hay subtareas asignadas.</p>
          @endif
        </div>
      @empty
        <p class="text-gray-600 mt-4">No tienes tareas asignadas.</p>
      @endforelse
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm mt-10">
      <p><a href="/" class="text-blue-500 hover:underline">PROPLAN</a></p>
      <p>{{ $usuario->nombre }}</p>
      <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button type="submit" class="text-red-600 hover:underline">Cerrar sesión</button>
      </form>
      <p class="mt-4">© 2025 PROPLAN. Todos los derechos reservados.</p>
    </footer>
  </div>

</body>
</html>


    

       