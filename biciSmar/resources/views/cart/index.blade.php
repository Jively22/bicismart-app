@extends('layouts.app')

@section('title','Carrito de compras')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Carrito de compras</h1>

    @if(empty($cart))
        <p>Tu carrito está vacío. Explora el <a href="{{ route('bicicletas.catalogo') }}">catálogo</a>.</p>
    @else
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-center">Cantidad</th>
                    <th>Precio (S/)</th>
                    <th>Subtotal (S/)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex justify-content-center">
                                @csrf
                                <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control form-control-sm w-auto me-2">
                                <button class="btn btn-sm btn-outline-success" type="submit">Actualizar</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['precio'],2) }}</td>
                        <td>{{ number_format($item['precio'] * $item['cantidad'],2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <span class="text-success">S/ {{ number_format($total,2) }}</span></h4>

            @auth
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-lg" type="submit">Confirmar compra</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Inicia sesión para comprar</a>
            @endauth
        </div>
    @endif
</div>
@endsection
