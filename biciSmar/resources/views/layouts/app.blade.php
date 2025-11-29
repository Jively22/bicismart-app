<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BiciSmart</title>

    {{-- Cargar Tailwind + JS compilado por Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f7f7f7;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <nav class="bg-green-700 text-white px-10 py-4 shadow-lg">
        <div class="flex justify-between items-center">

            <a href="{{ url('/') }}" class="text-2xl font-bold">BiciSmart</a>

            <div class="flex space-x-6 text-lg font-medium">
                <a href="/bicicletas" class="hover:text-gray-200">Bicicletas</a>
                <a href="/mantenimientos" class="hover:text-gray-200">Mantenimientos</a>
                <a href="/carrito" class="hover:text-gray-200">Carrito</a>

                @guest
                    <a href="/login" class="hover:text-gray-200">Ingresar</a>
                    <a href="/register" class="hover:text-gray-200">Registrarse</a>
                @else
                    <a href="/mis-alquileres" class="hover:text-gray-200">Mis Alquileres</a>

                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button class="hover:text-gray-200">Salir</button>
                    </form>
                @endguest
            </div>

        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

</body>
</html>
