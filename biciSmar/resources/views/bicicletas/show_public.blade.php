@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-8">
    <div>
        @if($bicicleta->foto)
            <img src="{{ asset('storage/'.$bicicleta->foto) }}" alt="{{ $bicicleta->nombre }}"
                 class="w-full rounded-2xl shadow">
        @else
            <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center">
                <span class="text-gray-500">Sin imagen</span>
            </div>
        @endif
    </div>
    <div>
        <h1 class="text-3xl font-bold text-green-700 mb-3">{{ $bicicleta->nombre }}</h1>
        <p class="text-gray-700 mb-4">{{ $bicicleta->descripcion }}</p>

        <div class="mb-4 space-y-1">
            @if($bicicleta->precio_venta)
                <p><strong>Precio de venta:</strong> S/ {{ number_format($bicicleta->precio_venta, 2) }}</p>
            @endif
            @if($bicicleta->precio_alquiler_hora)
                <p><strong>Precio alquiler por hora:</strong> S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}</p>
            @endif
            <p><strong>Tipo:</strong> {{ ucfirst($bicicleta->tipo) }}</p>
            <p><strong>Stock:</strong> {{ $bicicleta->stock }}</p>
        </div>

        @if($bicicleta->precio_venta)
            <form action="{{ route('cart.add', $bicicleta->id) }}" method="POST" class="inline-block">
                @csrf
                <button class="bg-green-600 text-white px-6 py-2 rounded-lg mr-2">
                    Añadir al carrito
                </button>
            </form>
        @endif

        @auth
            @if(auth()->user()->tipo_cliente === 'individual' && in_array($bicicleta->tipo, ['alquiler','mixto']))
                <a href="{{ route('alquileres.create.individual') }}"
                   class="inline-block border border-green-600 text-green-700 px-6 py-2 rounded-lg">
                    Alquilar (individual)
                </a>
            @elseif(auth()->user()->tipo_cliente === 'empresa' && in_array($bicicleta->tipo, ['alquiler','mixto']))
                <a href="{{ route('alquileres.create.corporativo') }}"
                   class="inline-block border border-green-600 text-green-700 px-6 py-2 rounded-lg">
                    Alquiler corporativo
                </a>
            @endif
        @endauth
    </div>
</div>
@endsection
