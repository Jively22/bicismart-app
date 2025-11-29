@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-4">Dashboard BiciSmart</h1>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm card-hover">
                <div class="card-body">
                    <h6 class="text-muted">Bicicletas registradas</h6>
                    <h3 class="fw-bold">{{ $totalBicicletas }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm card-hover">
                <div class="card-body">
                    <h6 class="text-muted">Alquileres</h6>
                    <h3 class="fw-bold">{{ $totalAlquileres }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm card-hover">
                <div class="card-body">
                    <h6 class="text-muted">Mantenimientos</h6>
                    <h3 class="fw-bold">{{ $totalMantenimientos }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm card-hover">
                <div class="card-body">
                    <h6 class="text-muted">Ventas totales (S/)</h6>
                    <h3 class="fw-bold">S/ {{ number_format($totalVentas,2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <p class="text-muted">
        Desde este panel el administrador puede gestionar el catálogo de bicicletas, los alquileres,
        los mantenimientos y visualizar el flujo principal de BiciSmart.
    </p>
</div>
@endsection
