@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-8">
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 overflow-hidden">
        @if($bicicleta->foto)
            <img src="{{ asset('storage/'.$bicicleta->foto) }}" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                Sin imagen
            </div>
        @endif
    </div>
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $bicicleta->nombre }}</h1>
        <p class="text-xs uppercase text-gray-500 mb-3">{{ ucfirst($bicicleta->tipo) }}</p>
        <p class="text-sm text-gray-700 mb-4">{{ $bicicleta->descripcion }}</p>

        <div class="space-y-1 text-sm mb-4">
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
                    <button class="px-5 py-2 rounded-full bg-green-700 text-white text-sm font-semibold hover:bg-green-800 transition">
                        Añadir al carrito
                    </button>
                </form>
            @endif
            @auth
                @if(auth()->user()->tipo_cliente === 'individual')
                    <a href="{{ route('alquileres.create.individual') }}"
                       class="px-4 py-2 rounded-full border border-green-700 text-green-800 text-xs font-semibold hover:bg-white hover:shadow">
                        Alquilar como usuario individual
                    </a>
                @elseif(auth()->user()->tipo_cliente === 'empresa')
                    <a href="{{ route('alquileres.create.corporativo') }}"
                       class="px-4 py-2 rounded-full border border-green-700 text-green-800 text-xs font-semibold hover:bg-white hover:shadow">
                        Alquilar como empresa
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
