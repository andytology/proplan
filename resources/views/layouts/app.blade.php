<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','PROPLAN')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- 1) Si ya tienes un css/app.css en public/css: -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- 2) O, directamente desde un CDN de Tailwind (opción “HTML puro”): -->
  {{-- <link href="https://unpkg.com/tailwindcss@^3/dist/tailwind.min.css" rel="stylesheet"> --}}
  
  @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">

  {{-- NAVBAR --}}
  <nav class="bg-white shadow px-4 py-3">
    <div class="container mx-auto flex justify-between items-center">
      <a href="{{ url('/') }}" class="text-xl font-bold">PROPLAN</a>
      <div class="space-x-4">
        @guest
          <a href="{{ route('login') }}" class="hover:underline">Iniciar sesión</a>
          <a href="{{ route('register') }}" class="hover:underline">Registrarse</a>
        @else
          <span>{{ Auth::user()->nombre }}</span>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:underline">Cerrar sesión</button>
          </form>
        @endguest
      </div>
    </div>
  </nav>

  {{-- CONTENIDO --}}
  <main class="container mx-auto py-8 px-4">
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="bg-white border-t py-4">
    <div class="container mx-auto text-center text-sm text-gray-600">
      © {{ date('Y') }} PROPLAN. Todos los derechos reservados.
    </div>
  </footer>

  <!-- 1) Si tienes un js/app.js en public/js: -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- 2) O, si prefieres un CDN (ej. Alpine.js para interactividad): -->
  {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}

  @stack('scripts')
</body>
</html>

