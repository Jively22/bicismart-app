@extends('layouts.app')

@section('title', $bicicleta->nombre)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <img src="{{ $bicicleta->imagen ?? 'https://images.pexels.com/photos/276517/pexels-photo-276517.jpeg' }}" 
                 alt="{{ $bicicleta->nombre }}" class="img-fluid rounded-4 shadow-sm">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold text-success">{{ $bicicleta->nombre }}</h1>
            <p class="small text-muted">{{ ucfirst($bicicleta->tipo) }}</p>
            <p>{{ $bicicleta->descripcion }}</p>
            @if($bicicleta->precio_venta)
                <p>Precio venta: <strong>S/ {{ number_format($bicicleta->precio_venta,2) }}</strong></p>
            @endif
            @if($bicicleta->precio_alquiler_hora)
                <p>Alquiler por hora: <strong>S/ {{ number_format($bicicleta->precio_alquiler_hora,2) }}</strong></p>
            @endif
            <p>Stock disponible: <strong>{{ $bicicleta->stock }}</strong></p>

            @if($bicicleta->precio_venta)
                <form action="{{ route('cart.add', $bicicleta) }}" method="POST" class="d-flex align-items-center mt-3">
                    @csrf
                    <input type="number" name="cantidad" value="1" min="1" class="form-control w-auto me-2">
                    <button type="submit" class="btn btn-success">Agregar al carrito</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
