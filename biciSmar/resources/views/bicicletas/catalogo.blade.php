@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Catálogo de Bicicletas</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($bicicletas as $bici)
        <div class="bg-white rounded-xl shadow p-4 flex flex-col">
            @if($bici->foto)
                <img src="{{ asset('storage/'.$bici->foto) }}" alt="{{ $bici->nombre }}"
                     class="w-full h-40 object-cover rounded mb-3">
            @else
                <div class="w-full h-40 bg-gray-200 rounded mb-3 flex items-center justify-center">
                    <span class="text-gray-500">Sin imagen</span>
                </div>
            @endif
            <h2 class="font-bold text-lg text-green-700">{{ $bici->nombre }}</h2>
            <p class="text-sm text-gray-600 flex-1">{{ $bici->descripcion }}</p>
            <div class="mt-3">
                @if($bici->precio_venta)
                    <p class="text-gray-800"><strong>Venta:</strong> S/ {{ number_format($bici->precio_venta, 2) }}</p>
                @endif
                @if($bici->precio_alquiler_hora)
                    <p class="text-gray-800"><strong>Alquiler hora:</strong> S/ {{ number_format($bici->precio_alquiler_hora, 2) }}</p>
                @endif
            </div>
            <div class="mt-4 flex space-x-2">
                <a href="{{ route('bicicletas.show.public', $bici->id) }}"
                   class="flex-1 text-center border border-green-600 text-green-700 px-3 py-2 rounded">
                    Ver detalle
                </a>
                @if($bici->precio_venta)
                    <form action="{{ route('cart.add', $bici->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button class="w-full bg-green-600 text-white px-3 py-2 rounded">
                            Añadir al carrito
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
