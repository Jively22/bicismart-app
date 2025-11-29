@extends('layouts.app')

@section('title','Inicio')

@section('content')
<section class="bg-bici text-white py-5">
    <div class="container d-flex flex-column flex-md-row align-items-center py-4">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold mb-3">BiciSmart: tu aliado en movilidad sostenible</h1>
            <p class="lead mb-4">
                Venta, alquiler individual y corporativo, además de mantenimiento profesional de bicicletas.
                Todo en una sola plataforma, con un flujo moderno y fácil de usar.
            </p>
            <a href="{{ route('bicicletas.catalogo') }}" class="btn btn-light btn-lg me-2 mb-2">Ver catálogo</a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg mb-2">Ir al carrito</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://images.pexels.com/photos/276517/pexels-photo-276517.jpeg" class="img-fluid rounded-4 shadow" alt="Bicicletas BiciSmart">
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="mb-4 fw-bold text-success text-center">Servicios BiciSmart</h2>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body">
                        <h5 class="card-title">Venta de bicicletas</h5>
                        <p class="card-text">Modelos urbanos, de ruta y montaña, listos para acompañarte cada día.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body">
                        <h5 class="card-title">Alquiler individual</h5>
                        <p class="card-text">Renta por horas o días para paseos, deporte o movilidad diaria.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body">
                        <h5 class="card-title">Alquiler corporativo</h5>
                        <p class="card-text">Planes para empresas que impulsan la movilidad sostenible para sus equipos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimiento</h5>
                        <p class="card-text">Servicios preventivos y correctivos para mantener tu bici siempre al 100%.</p>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($destacadas) && $destacadas->count())
            <hr class="my-5">
            <h2 class="mb-4 fw-bold text-success text-center">Bicicletas destacadas</h2>
            <div class="row g-4">
                @foreach($destacadas as $bici)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm card-hover h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bici->nombre }}</h5>
                                <p class="card-text small text-muted">{{ ucfirst($bici->tipo) }}</p>
                                @if($bici->precio_venta)
                                    <p class="mb-1">Precio venta: <strong>S/ {{ number_format($bici->precio_venta,2) }}</strong></p>
                                @endif
                                @if($bici->precio_alquiler_hora)
                                    <p class="mb-1">Alquiler x hora: <strong>S/ {{ number_format($bici->precio_alquiler_hora,2) }}</strong></p>
                                @endif
                                <a href="{{ route('bicicletas.show.public', $bici) }}" class="btn btn-sm btn-outline-success mt-2">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
