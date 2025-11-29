@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-primary">Carrito de compra</h1>
            <p class="text-muted mb-0">Gestiona las bicicletas que seleccionaste para compra o alquiler.</p>
        </div>
        <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(empty($cart))
        <div class="text-center text-muted py-5">
            <p class="mb-3">Aún no has agregado bicicletas.</p>
            <a href="{{ route('catalogo') }}" class="btn btn-primary">Explorar catálogo</a>
        </div>
    @else
        <div class="card shadow-sm border-0 mb-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Bicicleta</th>
                            <th>Modalidad</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td class="text-capitalize">{{ $item['modo'] }}</td>
                                <td>
                                    <form action="{{ route('carrito.update', $item['bicicleta_id']) }}" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control form-control-sm" style="width:90px;">
                                        <button class="btn btn-outline-primary btn-sm" type="submit">Actualizar</button>
                                    </form>
                                </td>
                                <td>S/ {{ number_format($item['precio_unitario'], 2) }}</td>
                                <td>S/ {{ number_format($item['subtotal'], 2) }}</td>
                                <td class="text-end">
                                    <form action="{{ route('carrito.remove', $item['bicicleta_id']) }}" method="POST" onsubmit="return confirm('¿Quitar del carrito?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <form action="{{ route('carrito.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿Vaciar carrito?');">Vaciar carrito</button>
            </form>
            <div class="text-end">
                <p class="fs-5 mb-1">Total: <strong>S/ {{ number_format($total, 2) }}</strong></p>
                <button class="btn btn-success" type="button"><i class="fas fa-check me-2"></i>Procesar pedido</button>
            </div>
        </div>
    @endif
</div>
@endsection