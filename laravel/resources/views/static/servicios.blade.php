@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-primary mb-3">Servicios</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold">Venta de bicicletas</h5>
                    <p class="text-muted">Modelos urbanos, de ruta y eléctricas con garantía y asesoría personalizada.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold">Alquiler individual y corporativo</h5>
                    <p class="text-muted">Planes por horas o días, y paquetes especiales para empresas y eventos.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold">Mantenimiento técnico</h5>
                    <p class="text-muted">Revisiones preventivas, reparaciones urgentes y puesta a punto completa.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection