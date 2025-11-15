<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100">
            <div class="sidebar-sticky pt-3">
                <h4 class="text-center mb-4">Panel Admin</h4>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('admin/bicicletas*') ? 'active bg-primary' : '' }}" 
                           href="{{ route('admin.bicicletas.index') }}">
                            <i class="fas fa-bicycle me-2"></i>
                            Gestión Bicicletas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('admin/alquileres*') ? 'active bg-primary' : '' }}" 
                           href="{{ route('admin.alquileres.index') }}">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Gestión Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('admin/mantenimientos*') ? 'active bg-primary' : '' }}" 
                           href="{{ route('admin.mantenimientos.index') }}">
                            <i class="fas fa-tools me-2"></i>
                            Gestión Mantenimiento
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <h2 class="mb-4">@yield('title', 'Dashboard Administrador')</h2>
                
                <!-- Estadísticas rápidas -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Bicicletas</h5>
                                <h2 class="card-text">{{ $totalBicicletas ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Alquileres Activos</h5>
                                <h2 class="card-text">{{ $alquileresActivos ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Mantenimientos</h5>
                                <h2 class="card-text">{{ $mantenimientosPendientes ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenido específico de cada módulo -->
                @yield('dashboard-content')
            </div>
        </div>
    </div>
</div>
@endsection