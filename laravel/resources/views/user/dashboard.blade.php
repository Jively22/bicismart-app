<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Usuario -->
        <div class="col-md-3 col-lg-2 bg-light min-vh-100">
            <div class="sidebar-sticky pt-3">
                <h4 class="text-center mb-4">Mi Cuenta</h4>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ request()->is('user/bicicletas*') ? 'active bg-info' : '' }}" 
                           href="{{ route('user.bicicletas.index') }}">
                            <i class="fas fa-bicycle me-2"></i>
                            Bicicletas Disponibles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ request()->is('user/alquileres*') ? 'active bg-info' : '' }}" 
                           href="{{ route('user.alquileres.index') }}">
                            <i class="fas fa-history me-2"></i>
                            Mis Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ request()->is('user/perfil*') ? 'active bg-info' : '' }}" 
                           href="{{ route('user.perfil') }}">
                            <i class="fas fa-user me-2"></i>
                            Mi Perfil
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <h2 class="mb-4">@yield('title', 'Dashboard Usuario')</h2>
                
                <!-- Bienvenida -->
                <div class="alert alert-info">
                    <h5>Bienvenido, {{ Auth::user()->name }}!</h5>
                    <p class="mb-0">Gestiona tus alquileres y descubre nuestras bicicletas disponibles.</p>
                </div>

                <!-- Contenido específico -->
                @yield('dashboard-content')
            </div>
        </div>
    </div>
</div>
@endsection