@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Tu bicicleta ideal te espera. Pregúntale a nuestra IA</h1>
                    <p class="hero-subtitle">
                        Encuentra la bicicleta perfecta para ti con la ayuda de nuestro asistente inteligente Bici IA. 
                        Venta, alquiler y mantenimiento en Lima, Perú.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a class="btn btn-light btn-lg px-4 py-2" href="{{ route('contacto') }}">
                            <i class="fas fa-robot me-2"></i>Habla con Bici IA
                        </a>
                        <a class="btn btn-outline-light btn-lg px-4 py-2" href="{{ route('catalogo') }}">
                            <i class="fas fa-bicycle me-2"></i>Ver Catálogo
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image mt-5 mt-lg-0">
                        <i class="fas fa-bicycle fa-10x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bicicletas Destacadas Section -->
    <section id="catalogo" class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Bicicletas Destacadas</h2>
                    <p class="lead text-muted">Descubre nuestra selección de las mejores bicicletas disponibles para comprar y alquilar.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Bicicleta 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title fw-bold">Trek X-Caliber 8</h5>
                                    <p class="text-muted mb-2">Trek</p>
                                </div>
                                <span class="badge bg-success">4.8 ★</span>
                            </div>
                            <p class="card-text text-muted mb-4">
                                Bicicleta de montaña profesional diseñada para terrenos difíciles y senderos extremos.
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Venta:</small>
                                    <h6 class="mb-0 text-success">S/ 3,200</h6>
                                </div>
                                <div>
                                    <small class="text-muted">Alquiler/h:</small>
                                    <h6 class="mb-0 text-primary">S/ 48.00</h6>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Comprar
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-calendar me-2"></i>Alquilar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bicicleta 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title fw-bold">Specialized Sirrus X 3.0</h5>
                                    <p class="text-muted mb-2">Specialized</p>
                                </div>
                                <span class="badge bg-success">4.3 ★</span>
                            </div>
                            <p class="card-text text-muted mb-4">
                                Perfecta para uso ágil en la ciudad. Cómoda, rápida y versátil.
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Venta:</small>
                                    <h6 class="mb-0 text-success">S/ 2,400</h6>
                                </div>
                                <div>
                                    <small class="text-muted">Alquiler/h:</small>
                                    <h6 class="mb-0 text-primary">S/ 35.00</h6>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Comprar
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-calendar me-2"></i>Alquilar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bicicleta 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title fw-bold">Giant TCR Advanced 2</h5>
                                    <p class="text-muted mb-2">Giant</p>
                                </div>
                                <span class="badge bg-success">4.5 ★</span>
                            </div>
                            <p class="card-text text-muted mb-4">
                                Bicicleta de carretera de alta rendimiento para ciclistas competitivos.
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Venta:</small>
                                    <h6 class="mb-0 text-success">S/ 4,800</h6>
                                </div>
                                <div>
                                    <small class="text-muted">Alquiler/h:</small>
                                    <h6 class="mb-0 text-primary">S/ 65.00</h6>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Comprar
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-calendar me-2"></i>Alquilar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-bicycle me-2"></i>Ver Todas las Bicicletas
                </a>
            </div>
        </div>
    </section>

    <!-- Servicio de Mantenimiento Section -->
    <section id="mantenimiento" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Servicio de Mantenimiento</h2>
                    <p class="lead text-muted">
                        Mantén tu bicicleta en perfecto estado con nuestros técnicos certificados. 
                        Disponible para cualquier marca, haya comprado o alquilado con nosotros.
                    </p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <!-- Servicio 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-tools fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Mantenimiento General</h5>
                            <p class="card-text text-muted mb-4">
                                Revisión completa, limpieza, lubricación y ajuste general de tu bicicleta.
                            </p>
                            <div class="mb-4">
                                <h4 class="text-success fw-bold">S/ 80</h4>
                                <small class="text-muted">Precio base</small>
                            </div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-calendar-plus me-2"></i>Agendar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-search fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Diagnóstico Técnico</h5>
                            <p class="card-text text-muted mb-4">
                                Evaluación profesional del estado de tu bicicleta y diagnóstico de problemas.
                            </p>
                            <div class="mb-4">
                                <h4 class="text-success fw-bold">S/ 50</h4>
                                <small class="text-muted">Precio base</small>
                            </div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-calendar-plus me-2"></i>Agendar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Servicio 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-cogs fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Reparación Especializada</h5>
                            <p class="card-text text-muted mb-4">
                                Arreglos específicos de suspensión, frenos, transmisión y componentes especializados.
                            </p>
                            <div class="mb-4">
                                <h4 class="text-success fw-bold">S/ 120</h4>
                                <small class="text-muted">Precio base</small>
                            </div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-calendar-plus me-2"></i>Agendar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuestros Técnicos -->
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h3 class="fw-bold mb-3">Nuestros Técnicos</h3>
                    <p class="text-muted">Profesionales certificados listos para ayudarte</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Técnico 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                            <h6 class="card-title fw-bold mb-1">Jorge Martínez</h6>
                            <div class="mb-3">
                                <span class="badge bg-success">4.9 ★</span>
                            </div>
                            <p class="card-text small text-muted mb-3">
                                Especialista en MTB y suspensiones
                            </p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Ver Disponibilidad
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Técnico 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                            <h6 class="card-title fw-bold mb-1">Andrea Castillo</h6>
                            <div class="mb-3">
                                <span class="badge bg-success">4.8 ★</span>
                            </div>
                            <p class="card-text small text-muted mb-3">
                                Especialista en bicicletas urbanas
                            </p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Ver Disponibilidad
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Técnico 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                            <h6 class="card-title fw-bold mb-1">Luis Vargas</h6>
                            <div class="mb-3">
                                <span class="badge bg-success">4.7 ★</span>
                            </div>
                            <p class="card-text small text-muted mb-3">
                                Especialista en transmisiones
                            </p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Ver Disponibilidad
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Técnico 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                            <h6 class="card-title fw-bold mb-1">Carmen López</h6>
                            <div class="mb-3">
                                <span class="badge bg-success">4.4 ★</span>
                            </div>
                            <p class="card-text small text-muted mb-3">
                                Especialista en frenos y ruedas
                            </p>
                            <button class="btn btn-outline-primary btn-sm w-100">
                                Ver Disponibilidad
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alquiler Corporativo Section -->
    <section id="alquiler-corporativo" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">Alquiler Corporativo de Bicicletas</h2>
                    <p class="lead text-muted mb-4">
                        Perfecto para eventos empresariales, team building y actividades corporativas en Lima.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Flotas completas para empresas</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Seguros incluidos</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Asistencia técnica en sitio</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Flexibilidad de horarios</li>
                    </ul>
                    <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-briefcase me-2"></i>Solicitar Cotización
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="corporate-image">
                        <i class="fas fa-users fa-10x text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3 class="display-6 fw-bold mb-3">¿Listo para empezar tu aventura?</h3>
                    <p class="lead mb-4">Únete a nuestra comunidad de ciclistas en Lima</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection