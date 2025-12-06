@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-[1.1fr,1fr] gap-8 items-start">
    <div class="surface-card rounded-3xl border border-green-100 overflow-hidden">
        @if($accesory->foto)
            <img src="{{ asset('storage/'.$accesory->foto) }}" class="w-full h-72 object-cover">
        @else
            <div class="w-full h-72 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                Sin imagen
            </div>
        @endif
    </div>
    <div class="space-y-4">
        <span class="pill capitalize">{{ $accesory->categoria ?? 'Accesorio' }}</span>
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $accesory->nombre }}</h1>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $accesory->descripcion }}</p>

        <div class="surface-card border border-green-50 p-4 space-y-2 text-sm">
            <p><span class="text-gray-500">Precio:</span>
               <span class="font-semibold text-green-700">S/ {{ number_format($accesory->precio, 2) }}</span></p>
            <p><span class="text-gray-500">Stock:</span> {{ $accesory->stock }}</p>
            <p>
                @if($accesory->tag === 'oficial')
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-semibold bg-green-50 text-green-700 border border-green-100">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Técnico oficial BiciSmart
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        Asociado externo
                    </span>
                @endif
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <form action="{{ route('cart.add.accessory', $accesory->id) }}" method="POST">
                @csrf
                <button class="btn-brand px-5">
                    Añadir al carrito
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
