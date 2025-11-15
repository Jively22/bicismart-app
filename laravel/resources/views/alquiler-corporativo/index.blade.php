@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white text-center">
                    <h3 class="mb-0">Alquiler Corporativo</h3>
                </div>
                <div class="card-body text-center py-5">
                    <i class="fas fa-briefcase fa-4x text-muted mb-4"></i>
                    <h4>Redireccionando...</h4>
                    <p class="text-muted">Serás redirigido al formulario de alquiler corporativo.</p>
                    
                    <script>
                        // Redirigir automáticamente al formulario
                        setTimeout(function() {
                            window.location.href = "{{ route('alquiler-corporativo.create') }}";
                        }, 2000);
                    </script>
                    
                    <div class="mt-4">
                        <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Ir al Formulario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection