@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detalles de Bicicleta</h3>
                    <a href="{{ route('bicicletas.index') }}" class="btn btn-secondary">Volver</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Marca:</strong>
                            <p class="form-control-plaintext">{{ $bicicleta->marca }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Modelo:</strong>
                            <p class="form-control-plaintext">{{ $bicicleta->modelo }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tipo:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-primary">{{ $bicicleta->tipo }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tamaño:</strong>
                            <p class="form-control-plaintext">{{ $bicicleta->tamaño }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $bicicleta->estado == 'nuevo' ? 'success' : 'warning' }}">
                                    {{ $bicicleta->estado }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Precio Venta:</strong>
                            <p class="form-control-plaintext">
                                @if($bicicleta->precio_venta)
                                    S/ {{ number_format($bicicleta->precio_venta, 2) }}
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Precio Alquiler/Hora:</strong>
                            <p class="form-control-plaintext">
                                @if($bicicleta->precio_alquiler_hora)
                                    S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Disponible para Venta:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $bicicleta->disponible_para_venta ? 'success' : 'danger' }}">
                                    {{ $bicicleta->disponible_para_venta ? 'Sí' : 'No' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Disponible para Alquiler:</strong>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $bicicleta->disponible_para_alquiler ? 'success' : 'danger' }}">
                                    {{ $bicicleta->disponible_para_alquiler ? 'Sí' : 'No' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Descripción:</strong>
                            <p class="form-control-plaintext">{{ $bicicleta->descripcion }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('bicicletas.edit', $bicicleta) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('bicicletas.index') }}" class="btn btn-secondary">Volver a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection