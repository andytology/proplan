{{-- resources/views/jefe/dashboard-simple.blade.php --}}
@extends('layouts.app')

@section('title', 'Panel Jefe de Proyecto')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-6">
  <h1 class="text-2xl font-semibold mb-4">¡Hola, {{ auth()->user()->nombre }}!</h1>
  <p class="text-lg">
    Tu rol es: <span class="font-bold">{{ auth()->user()->rol }}</span>
  </p>
</div>
@endsection

