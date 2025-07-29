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
        <div class="mt-4 md:mt-0 flex space-x-3">
           
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                Exportar CSV
            </a>
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

    

@push('styles')
    {{-- Si necesitas estilos adicionales --}}
@endpush

@push('scripts')
    {{-- Si necesitas scripts adicionales --}}
@endpush