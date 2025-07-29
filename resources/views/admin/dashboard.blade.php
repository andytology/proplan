{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-6 rounded shadow">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">Dashboard de Administrador</h1>
            <p class="mt-1 text-gray-600">¡Hola, {{ auth()->user()->nombre }}!</p>
        </div>
       
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        {{-- Usuarios --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500">Usuarios</h3>
            <p class="mt-2 text-3xl font-bold"></p>
        </div>

        {{-- Proyectos --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500">Proyectos</h3>
            <p class="mt-2 text-3xl font-bold"></p>
        </div>

        {{-- Tareas --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500">Tareas</h3>
            <p class="mt-2 text-3xl font-bold"></p>
        </div>
    </div>

    {{-- Búsqueda y tabla de usuarios --}}
    <div class="bg-white p-6 rounded shadow">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Usuarios registrados</h2>
            
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Buscar usuario..."
                       class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
               
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}

    </div>
</div>
@endsection

@push('styles')
    {{-- Si necesitas estilos adicionales --}}
@endpush

@push('scripts')
    {{-- Si necesitas scripts adicionales --}}
@endpush
