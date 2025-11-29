@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-primary">Catálogo de bicicletas</h1>
            <p class="text-muted mb-0">Explora las opciones disponibles para compra o alquiler y agrégalas a tu carrito.</p>
        </div>
        <a href="{{ route('carrito.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-shopping-cart me-2"></i>Ver carrito
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        @forelse($bicicletas as $bicicleta)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $bicicleta->marca }} {{ $bicicleta->modelo }}</h5>
                                <span class="badge bg-secondary text-uppercase">{{ $bicicleta->tipo }}</span>
                            </div>
                            @if($bicicleta->disponible_para_alquiler)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-warning text-dark">Ocupada</span>
                            @endif
                        </div>
                        <p class="text-muted flex-grow-1">{{ Str::limit($bicicleta->descripcion, 120) }}</p>
                        <div class="mb-3">
                            @if($bicicleta->precio_venta)
                                <div><small class="text-muted">Venta</small> <strong>S/ {{ number_format($bicicleta->precio_venta, 2) }}</strong></div>
                            @endif
                            @if($bicicleta->precio_alquiler_hora)
                                <div><small class="text-muted">Alquiler por hora</small> <strong>S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}</strong></div>
                            @endif
                        </div>
                        <form action="{{ route('carrito.add') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="bicicleta_id" value="{{ $bicicleta->id }}">
                            <div class="row g-2 align-items-end">
                                <div class="col-6">
                                    <label class="form-label">Modalidad</label>
                                    <select name="modo" class="form-select form-select-sm">
                                        <option value="venta">Compra</option>
                                        <option value="alquiler">Alquiler</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Cantidad</label>
                                    <input type="number" name="cantidad" value="1" min="1" class="form-control form-control-sm">
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fas fa-cart-plus me-1"></i>Agregar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>No hay bicicletas registradas todavía.</p>
                <a href="{{ route('bicicletas.create') }}" class="btn btn-primary">Agregar primera bicicleta</a>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $bicicletas->links() }}
    </div>
</div>
@endsection