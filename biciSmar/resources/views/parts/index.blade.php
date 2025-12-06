@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">
    <div>
        <span class="pill mb-2 inline-flex">Accesorios & Merch</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Partes, repuestos y merch</h1>
        <p class="text-sm text-gray-600 mt-1">Equipa tu bici con productos oficiales y asociados.</p>
    </div>
    <div class="surface-card px-4 py-3 border border-green-50 text-sm text-gray-700">
        <p class="font-semibold text-gray-900">{{ $items->count() }} productos</p>
        <p class="text-xs text-gray-500">Stock limitado, entrega rápida.</p>
    </div>
</div>

<form method="GET" class="surface-card border border-green-50 p-4 mb-6 grid md:grid-cols-4 gap-3">
    <div class="form-field">
        <label>Categoría</label>
        <select name="categoria">
            <option value="">Todas</option>
            <option value="parte" @selected(request('categoria')==='parte')>Partes</option>
            <option value="repuesto" @selected(request('categoria')==='repuesto')>Repuestos</option>
            <option value="merch" @selected(request('categoria')==='merch')>Merch</option>
        </select>
    </div>
    <div class="form-field">
        <label>Proveedor</label>
        <select name="tag">
            <option value="">Todos</option>
            <option value="oficial" @selected(request('tag')==='oficial')>Técnico oficial</option>
            <option value="asociado" @selected(request('tag')==='asociado')>Asociado externo</option>
        </select>
    </div>
    <div class="form-field">
        <label>Precio máximo</label>
        <input type="number" step="0.01" name="precio_max" value="{{ request('precio_max') }}">
    </div>
    <div class="md:col-span-4 flex gap-2 justify-end">
        <a href="{{ route('accesorios.index') }}" class="btn-ghost text-sm px-4">Limpiar</a>
        <button class="btn-brand text-sm px-5">Filtrar</button>
    </div>
</form>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($items as $item)
        <div class="surface-card border border-green-50 overflow-hidden flex flex-col hover:shadow-xl transition">
            <div class="relative">
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nombre }}" class="w-full h-44 object-cover">
                @else
                    <div class="w-full h-44 bg-gradient-to-r from-green-600 to-emerald-400 flex items-center justify-center text-white text-sm">
                        Sin imagen
                    </div>
                @endif
                <span class="absolute top-3 left-3 badge-soft uppercase text-[11px]">{{ ucfirst($item->categoria) }}</span>
            </div>
            <div class="p-4 flex-1 flex flex-col gap-2">
                <h2 class="font-bold text-base text-gray-900">{{ $item->nombre }}</h2>
                <p class="text-xs text-gray-600 line-clamp-3 flex-1">{{ $item->descripcion }}</p>
                @if($item->tag === 'oficial')
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
                <div class="mt-2 flex items-center justify-between text-sm">
                    <span class="font-semibold text-green-700">S/ {{ number_format($item->precio, 2) }}</span>
                    <span class="text-xs text-gray-500 capitalize">{{ $item->categoria }}</span>
                </div>
                <div class="mt-2 flex gap-2">
                    <form action="{{ route('cart.add.accessory', $item->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button class="btn-brand text-xs px-3 w-full justify-center">Añadir al carrito</button>
                    </form>
                    <a href="{{ route('accesorios.show', $item->id) }}" class="btn-ghost text-xs px-3 flex-1 justify-center text-center">Ver detalles</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
