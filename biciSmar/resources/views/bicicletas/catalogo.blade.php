@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Catálogo de bicicletas</h1>
        <p class="text-xs text-gray-600 mt-1">Explora modelos para venta, alquiler individual y flotas corporativas.</p>
    </div>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($bicicletas as $bici)
        <div class="group bg-white/95 rounded-3xl shadow-md border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition">
            <div class="relative">
                @if($bici->foto)
                    <img src="{{ asset('storage/'.$bici->foto) }}" alt="{{ $bici->nombre }}"
                         class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                        Sin imagen
                    </div>
                @endif
                <span class="absolute top-3 left-3 text-[10px] uppercase px-2 py-1 rounded-full bg-white/90 text-green-700 font-semibold">
                    {{ ucfirst($bici->tipo) }}
                </span>
            </div>

            <div class="p-4 flex-1 flex flex-col">
                <h2 class="font-bold text-sm text-gray-900 mb-1">{{ $bici->nombre }}</h2>
                <p class="text-[11px] text-gray-600 line-clamp-3 flex-1">{{ $bici->descripcion }}</p>

                <div class="mt-3 space-y-1 text-xs">
                    @if($bici->precio_venta)
                        <p><span class="text-gray-500">Venta:</span>
                           <span class="font-semibold text-green-700">S/ {{ number_format($bici->precio_venta, 2) }}</span>
                        </p>
                    @endif
                    @if($bici->precio_alquiler_hora)
                        <p><span class="text-gray-500">Alquiler hora:</span>
                           <span class="font-semibold text-green-700">S/ {{ number_format($bici->precio_alquiler_hora, 2) }}</span>
                        </p>
                    @endif
                </div>

                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('bicicletas.show.public', $bici->id) }}"
                       class="flex-1 text-center text-[11px] px-3 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                        Ver más
                    </a>

                    @if($bici->precio_venta)
                        <form action="{{ route('cart.add', $bici->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button
                                class="w-full text-[11px] px-3 py-2 rounded-full bg-green-700 text-white font-semibold hover:bg-green-800 transition">
                                Añadir al carrito
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
