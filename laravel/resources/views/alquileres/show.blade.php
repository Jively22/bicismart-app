@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detalles del Alquiler</h3>
                    <a href="{{ route('alquileres.index') }}" class="btn btn-secondary">Volver</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Usuario:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->usuario->name }} ({{ $alquiler->usuario->email }})</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Bicicleta:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->bicicleta->marca }} {{ $alquiler->bicicleta->modelo }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tipo de Alquiler:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $alquiler->tipo_alquiler == 'individual' ? 'info' : 'warning' }}">
                                    {{ $alquiler->tipo_alquiler }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Cantidad de Bicicletas:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->cantidad_bicicletas }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Fecha de Inicio:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->fecha_inicio->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Fecha de Fin:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->fecha_fin->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $alquiler->estado == 'activo' ? 'success' : ($alquiler->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                                    {{ $alquiler->estado }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Total:</strong>
                            <p class="form-control-plaintext">S/ {{ number_format($alquiler->total, 2) }}</p>
                        </div>
                    </div>

                    @if($alquiler->tipo_alquiler == 'corporativo')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Razón Social:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->razon_social ?? 'No especificado' }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>RUC Empresa:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->ruc_empresa ?? 'No especificado' }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Fecha de Creación:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Última Actualización:</strong>
                            <p class="form-control-plaintext">{{ $alquiler->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('alquileres.edit', $alquiler) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('alquileres.index') }}" class="btn btn-secondary">Volver a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection