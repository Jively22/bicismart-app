<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiciSmart · Bicicletas, alquiler y mantenimiento</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top left, #e0f7ec, #f8fafc 55%, #e0f2fe);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-gray-800">

    <header class="sticky top-0 z-30 bg-green-800/95 backdrop-blur shadow-md">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-700" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 18L8 9H10L8 18H5Z" fill="currentColor"/>
                        <path d="M16 6C14.8954 6 14 6.89543 14 8C14 9.10457 14.8954 10 16 10C17.1046 10 18 9.10457 18 8C18 6.89543 17.1046 6 16 6Z" fill="currentColor"/>
                        <path d="M6 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H14L12 10H9L11 16H6C4.89543 16 4 16.8954 4 18C4 19.1046 4.89543 20 6 20Z" fill="currentColor"/>
                    </svg>
                </div>
                <a href="{{ route('home') }}" class="font-bold text-xl tracking-tight text-white">
                    BiciSmart
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('home') }}"
                   class="text-gray-100 hover:text-white transition">Home</a>
                <a href="{{ route('bicicletas.catalogo') }}"
                   class="text-gray-100 hover:text-white transition">Bicicletas</a>
                <a href="{{ route('mantenimientos.public') }}"
                   class="text-gray-100 hover:text-white transition">Mantenimientos</a>
                <a href="{{ route('cart.index') }}"
                   class="text-gray-100 hover:text-white transition">Carrito</a>
                @auth
                    <a href="{{ route('cart.historial') }}"
                       class="text-gray-100 hover:text-white transition">Mis compras</a>
                    <a href="{{ route('alquileres.mis') }}"
                       class="text-gray-100 hover:text-white transition">Mis alquileres</a>
                    @if(auth()->user()->esAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-yellow-300 hover:text-yellow-200 transition">Panel admin</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center space-x-2">
                @guest
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline-block px-3 py-1.5 rounded-full border border-white/40 text-white text-sm hover:bg-white hover:text-green-800 transition">
                        Ingresar
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-1.5 rounded-full bg-white text-green-800 text-sm font-semibold shadow hover:bg-yellow-100 transition">
                        Registrarse
                    </a>
                @else
                    <span class="hidden sm:inline text-gray-100 text-sm mr-1">
                        Hola, {{ strtok(auth()->user()->name, ' ') }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="px-3 py-1.5 rounded-full bg-white/10 text-gray-100 text-xs font-semibold border border-white/40 hover:bg-white hover:text-green-800 transition">
                            Salir
                        </button>
                    </form>
                @endguest
            </div>
        </nav>
    </header>

    @if(session('success'))
        <div class="max-w-3xl mx-auto mt-5 px-4">
            <div class="flex items-center space-x-3 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm">
                <span class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">✓</span>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <main class="flex-1 flex">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @yield('content')
        </div>
    </main>

    <footer class="mt-10 bg-green-900 text-gray-200 text-xs py-4">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
            <span>© {{ date('Y') }} BiciSmart • Movilidad sostenible</span>
            <span class="text-gray-300">Venta · Alquiler individual y corporativo · Mantenimiento interno y externo</span>
        </div>
    </footer>

</body>
</html>
