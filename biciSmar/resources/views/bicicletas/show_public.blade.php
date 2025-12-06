@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-[1.1fr,1fr] gap-8 items-start">
    <div class="surface-card rounded-3xl border border-green-100 overflow-hidden">
        @if($bicicleta->foto)
            <img src="{{ asset('storage/'.$bicicleta->foto) }}" class="w-full h-72 object-cover">
        @else
            <div class="w-full h-72 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                Sin imagen
            </div>
        @endif
    </div>
    <div class="space-y-4">
        <span class="pill">{{ ucfirst($bicicleta->tipo) }}</span>
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $bicicleta->nombre }}</h1>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $bicicleta->descripcion }}</p>

        @isset($avgRating)
            <div class="flex items-center gap-2 text-sm text-amber-500">
                <span class="font-semibold">{{ $avgRating }} / 5</span>
                <span>{{ str_repeat('★', floor($avgRating)) . str_repeat('☆', 5 - floor($avgRating)) }}</span>
                <span class="text-gray-500 text-xs">({{ $reviews->count() }} reseñas)</span>
            </div>
        @endisset

        <div class="surface-card border border-green-50 p-4 space-y-2 text-sm">
            @if($bicicleta->precio_venta)
                <p><span class="text-gray-500">Precio de venta:</span>
                   <span class="font-semibold text-green-700">S/ {{ number_format($bicicleta->precio_venta, 2) }}</span></p>
            @endif
            @if($bicicleta->precio_alquiler_hora)
                <p><span class="text-gray-500">Alquiler por hora:</span>
                   <span class="font-semibold text-green-700">S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}</span></p>
            @endif
            <p><span class="text-gray-500">Stock:</span> {{ $bicicleta->stock }}</p>
        </div>

        <div class="flex flex-wrap gap-3">
            @if($bicicleta->precio_venta)
                <form action="{{ route('cart.add', $bicicleta->id) }}" method="POST">
                    @csrf
                    <button class="btn-brand px-5">
                        Añadir al carrito
                    </button>
                </form>
            @endif
            @auth
                @if(auth()->user()->tipo_cliente === 'individual')
                    <a href="{{ route('alquileres.create.individual') }}"
                       class="btn-ghost text-xs px-4">
                        Alquilar como usuario individual
                    </a>
                @elseif(auth()->user()->tipo_cliente === 'empresa')
                    <a href="{{ route('alquileres.create.corporativo') }}"
                       class="btn-ghost text-xs px-4">
                        Alquilar como empresa
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>

@isset($reviews)
<div class="mt-10">
    <h2 class="text-xl font-extrabold text-gray-900 mb-3">Reseñas</h2>
    <div class="space-y-3">
        @foreach($reviews as $review)
            <div class="surface-card border border-green-50 p-3 rounded-2xl">
                <div class="flex items-center justify-between text-sm">
                    <span class="font-semibold text-gray-800">{{ $review['user'] }}</span>
                    <span class="text-amber-500">{{ $review['stars'] }}</span>
                </div>
                <p class="text-sm text-gray-700 mt-1">{{ $review['comment'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endisset
@endsection
