<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiciSmart - Venta y Alquiler de Bicicletas</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 5rem 0;
        }
        
        .service-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 2rem;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: #10b981;">
                BiciSmart
            </a>
            
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Tu viaje comienza con BiciSmart</h1>
                    <p class="lead mb-4">Plataforma integral para comprar, alquilar y mantener tu bicicleta en Lima</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-light btn-lg">
                            Alquiler Corporativo
                        </a>
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                            Crear Cuenta
                        </a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-bicycle fa-8x opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold">Nuestros Servicios</h2>
                    <p class="text-muted">Todo lo que necesitas en un solo lugar</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-shopping-cart fa-3x mb-3" style="color: #10b981;"></i>
                            <h5 class="card-title">Compra de Bicicletas</h5>
                            <p class="card-text">Encuentra la bicicleta perfecta para ti entre nuestro catálogo amplio.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #10b981;"></i>
                            <h5 class="card-title">Alquiler Flexible</h5>
                            <p class="card-text">Individual por horas/días o corporativo para eventos empresariales.</p>
                            <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-outline-primary mt-2">Solicitar</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card service-card shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-tools fa-3x mb-3" style="color: #10b981;"></i>
                            <h5 class="card-title">Mantenimiento</h5>
                            <p class="card-text">Servicio técnico especializado con los mejores profesionales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>BiciSmart</h5>
                    <p>Tu plataforma de confianza para movilidad sostenible en Lima.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2025 BiciSmart. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>