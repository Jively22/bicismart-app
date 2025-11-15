@extends('layouts.dashboard')

@section('page-title', 'Detalles del Mantenimiento')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalles del Mantenimiento #{{ $mantenimiento->id }}</h4>
                    <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información del Cliente</h5>
                            <div class="mb-3">
                                <strong>Nombre:</strong><br>
                                {{ $mantenimiento->usuario->name }}
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong><br>
                                {{ $mantenimiento->usuario->email }}
                            </div>
                            <div class="mb-3">
                                <strong>Rol:</strong><br>
                                <span class="badge bg-primary">{{ $mantenimiento->usuario->role }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="text-primary">Información del Técnico</h5>
                            <div class="mb-3">
                                <strong>Nombre:</strong><br>
                                {{ $mantenimiento->tecnico->name }}
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong><br>
                                {{ $mantenimiento->tecnico->email }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información de la Bicicleta</h5>
                            <div class="mb-3">
                                <strong>Marca:</strong><br>
                                {{ $mantenimiento->marca_bicicleta }}
                            </div>
                            <div class="mb-3">
                                <strong>Modelo:</strong><br>
                                {{ $mantenimiento->modelo_bicicleta }}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="text-primary">Estado y Precio</h5>
                            @php
                                $estadoColors = [
                                    'pendiente' => 'warning',
                                    'aceptado' => 'info', 
                                    'en_proceso' => 'primary',
                                    'completado' => 'success',
                                    'cancelado' => 'danger'
                                ];
                            @endphp
                            <div class="mb-3">
                                <strong>Estado:</strong><br>
                                <span class="badge bg-{{ $estadoColors[$mantenimiento->estado] ?? 'secondary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $mantenimiento->estado)) }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Precio Pactado:</strong><br>
                                @if($mantenimiento->precio_pactado)
                                    <span class="h5 text-success">S/ {{ number_format($mantenimiento->precio_pactado, 2) }}</span>
                                @else
                                    <span class="text-muted">Por cotizar</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-primary">Descripción del Problema</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $mantenimiento->descripcion_problema }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <strong>Fecha de Creación:</strong><br>
                            {{ $mantenimiento->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Última Actualización:</strong><br>
                            {{ $mantenimiento->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Volver a la Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection