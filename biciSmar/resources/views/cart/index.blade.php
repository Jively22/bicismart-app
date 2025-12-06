@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Carrito de compras</h1>

@if($errors->has('checkout'))
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-2xl mb-4">
        {{ $errors->first('checkout') }}
    </div>
@endif

@if(empty($cart))
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-6 text-center">
        <p class="text-sm text-gray-700 mb-2">Tu carrito está vacío.</p>
        <a href="{{ route('bicicletas.catalogo') }}" class="text-sm text-green-700 font-semibold hover:underline">
            Ver catálogo de bicicletas
        </a>
    </div>
@else
    <div class="grid lg:grid-cols-[3fr,2fr] gap-6">
        <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4">
            @foreach($bicicletas as $bici)
                <div class="flex items-center border-b last:border-b-0 py-3">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 overflow-hidden mr-3">
                        @if($bici->foto)
                            <img src="{{ asset('storage/'.$bici->foto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-500">
                                Sin imagen
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ $bici->nombre }}</p>
                        <p class="text-[11px] text-gray-500">
                            Precio: S/ {{ number_format($bici->precio_venta, 2) }}
                        </p>
                        <form action="{{ route('cart.update', $bici->id) }}" method="POST" class="mt-1 flex items-center space-x-2">
                            @csrf
                            <input type="number" name="cantidad" value="{{ $cart[$bici->id] }}"
                                   class="w-16 text-xs border rounded-lg px-2 py-1">
                            <button class="text-[11px] text-blue-600 hover:underline">Actualizar</button>
                        </form>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600">Subtotal</p>
                        <p class="text-sm font-semibold text-green-700">
                            S/ {{ number_format($bici->precio_venta * $cart[$bici->id], 2) }}
                        </p>
                        <form action="{{ route('cart.remove', $bici->id) }}" method="POST" class="mt-1">
                            @csrf
                            <button class="text-[11px] text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-5 flex flex-col justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-900 mb-3">Resumen</h2>
                <div class="flex justify-between text-xs text-gray-600 mb-2">
                    <span>Subtotal</span>
                    <span>S/ {{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between text-xs text-gray-600 mb-2">
                    <span>Envío</span>
                    <span>Incluido</span>
                </div>
                <div class="border-t border-dashed my-3"></div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-semibold text-gray-700">Total a pagar</span>
                    <span class="text-xl font-bold text-green-700">S/ {{ number_format($total, 2) }}</span>
                </div>
            </div>

            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
                @csrf
                <button
                    class="w-full py-2.5 rounded-xl bg-green-700 text-white text-sm font-semibold shadow-md hover:bg-green-800 transition">
                    Confirmar compra
                </button>
            </form>
        </div>
    </div>
@endif
@endsection
