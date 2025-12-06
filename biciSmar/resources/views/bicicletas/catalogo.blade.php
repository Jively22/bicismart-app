@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">
    <div>
        <span class="pill mb-2 inline-flex">Catálogo</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Bicicletas listas para rodar</h1>
        <p class="text-sm text-gray-600 mt-1">Explora modelos para venta, alquiler individual o flotas corporativas.</p>
    </div>
    <div class="surface-card px-4 py-3 border border-green-50 text-sm text-gray-700">
        <p class="font-semibold text-gray-900">{{ $bicicletas->count() }} modelos activos</p>
        <p class="text-xs text-gray-500">Entrega rápida y mantenimiento incluido según plan.</p>
    </div>
</div>

<form method="GET" class="surface-card border border-green-50 p-4 mb-6 grid md:grid-cols-4 gap-3">
    <div class="form-field">
        <label>Buscar</label>
        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Nombre o descripción">
    </div>
    <div class="form-field">
        <label>Ordenar por</label>
        <select name="ordenar">
            <option value="">Más reciente</option>
            <option value="popular" @selected(request('ordenar')==='popular')>Más popular</option>
            <option value="price_desc" @selected(request('ordenar')==='price_desc')>Precio: mayor a menor</option>
            <option value="price_asc" @selected(request('ordenar')==='price_asc')>Precio: menor a mayor</option>
            <option value="rating" @selected(request('ordenar')==='rating')>Mejor valoradas</option>
        </select>
    </div>
    <div class="form-field">
        <label>Precio mínimo</label>
        <input type="number" step="0.01" name="precio_min" value="{{ request('precio_min') }}">
    </div>
    <div class="form-field">
        <label>Precio máximo</label>
        <input type="number" step="0.01" name="precio_max" value="{{ request('precio_max') }}">
    </div>
    <div class="md:col-span-4 flex gap-2 justify-end">
        <a href="{{ route('bicicletas.catalogo') }}" class="btn-ghost text-sm px-4">Limpiar</a>
        <button class="btn-brand text-sm px-5">Aplicar filtros</button>
    </div>
</form>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($bicicletas as $bici)
        <div class="surface-card border border-green-50 overflow-hidden flex flex-col hover:shadow-2xl transition-shadow">
            <div class="relative">
                @if($bici->foto)
                    <img src="{{ asset('storage/'.$bici->foto) }}" alt="{{ $bici->nombre }}" class="w-full h-44 object-cover">
                @else
                    <div class="w-full h-44 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                        Sin imagen
                    </div>
                @endif
                <span class="absolute top-3 left-3 badge-soft uppercase text-[11px]">{{ ucfirst($bici->tipo) }}</span>
            </div>

            <div class="p-4 flex-1 flex flex-col gap-2">
                <h2 class="font-bold text-base text-gray-900">{{ $bici->nombre }}</h2>
                <p class="text-xs text-gray-600 line-clamp-3 flex-1">{{ $bici->descripcion }}</p>

                @php
                    $rating = $bici->rating ?? (($bici->id % 5) + 1);
                @endphp
                <div class="flex items-center gap-2 text-xs text-amber-500 mt-1">
                    <span>{{ str_repeat('★', $rating) }}{{ str_repeat('☆', 5 - $rating) }}</span>
                    <span class="text-gray-500">({{ $rating }}/5)</span>
                </div>

                <div class="mt-2 space-y-1 text-sm">
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

                <div class="mt-3 flex gap-2">
                    <a href="{{ route('bicicletas.show.public', $bici->id) }}"
                       class="btn-ghost text-[12px] flex-1 justify-center">
                        Ver ficha
                    </a>

                    @if($bici->precio_venta)
                        <form action="{{ route('cart.add', $bici->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button
                                class="btn-brand w-full justify-center text-[12px]">
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
