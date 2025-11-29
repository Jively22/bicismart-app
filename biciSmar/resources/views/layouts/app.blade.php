<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BiciSmart - @yield('title','Tu mundo en bicicletas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap minimal + custom green theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #16a34a;
            --bs-primary-rgb: 22,163,74;
        }
        body {
            background-color: #f8fafc;
        }
        .navbar-brand span {
            font-weight: 800;
        }
        .btn-primary {
            background-color: #16a34a;
            border-color: #16a34a;
        }
        .btn-primary:hover {
            background-color: #15803d;
            border-color: #15803d;
        }
        .bg-bici {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }
        .nav-link.active {
            font-weight: 600;
            color: #16a34a !important;
        }
        footer {
            background-color: #022c22;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="text-success">BiciSmart</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
                <li class="nav-item"><a href="{{ route('bicicletas.catalogo') }}" class="nav-link {{ request()->routeIs('bicicletas.catalogo') ? 'active' : '' }}">Catálogo</a></li>
                <li class="nav-item"><a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">Carrito</a></li>

                @auth
                    <li class="nav-item"><a href="{{ route('alquileres.mis') }}" class="nav-link">Mis alquileres</a></li>
                    <li class="nav-item"><a href="{{ route('mantenimientos.mis') }}" class="nav-link">Mis mantenimientos</a></li>
                @endauth

                @auth
                    @if(auth()->user()->esAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success" href="#" data-bs-toggle="dropdown">Admin</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('bicicletas.index') }}">Bicicletas</a></li>
                                <li><a class="dropdown-item" href="{{ route('alquileres.index') }}">Alquileres</a></li>
                                <li><a class="dropdown-item" href="{{ route('mantenimientos.index') }}">Mantenimientos</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item d-flex align-items-center me-2">
                        <span class="small text-muted me-2">Hola, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-success btn-sm" type="submit">Salir</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-success btn-sm me-2">Ingresar</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-success btn-sm">Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="pt-5 mt-4">
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @yield('content')
</main>

<footer class="text-white mt-5 py-4">
    <div class="container d-flex justify-content-between flex-wrap">
        <p class="mb-0">© {{ date('Y') }} BiciSmart. Todos los derechos reservados.</p>
        <p class="mb-0">Venta, alquiler y mantenimiento inteligente de bicicletas.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
