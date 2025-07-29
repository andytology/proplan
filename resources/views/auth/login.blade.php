@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="max-w-md mx-auto mt-12">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Iniciar sesión</h1>

        {{-- Mensaje de estado (p. ej. “Revisa tu email para restablecer contraseña”) --}}
        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Recuérdame + Olvidé contraseña --}}
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-500"
                    >
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            {{-- Botón de submit --}}
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow
                           hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Iniciar sesión
                </button>
            </div>
        </form>

        {{-- Enlace a registro --}}
        <p class="mt-6 text-center text-sm text-gray-600">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                Regístrate aquí
            </a>.
        </p>
    </div>
</div>
@endsection


