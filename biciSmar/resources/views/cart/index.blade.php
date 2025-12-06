@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Carrito</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Carrito de compras</h1>
        <p class="text-sm text-gray-600">Revisa cantidades y confirma tu pedido.</p>
    </div>
</div>

@if($errors->any())
    <div class="surface-card border border-red-200 text-red-700 text-sm px-4 py-3 mb-4 space-y-1">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(empty($cart) && empty($cartAccessories))
    <div class="surface-card border border-green-50 p-6 text-center">
        <p class="text-sm text-gray-700 mb-2">Tu carrito esta vacio.</p>
        <a href="{{ route('bicicletas.catalogo') }}" class="btn-brand text-sm px-4">
            Ver catalogo de bicicletas
        </a>
    </div>
@else
    <div class="grid lg:grid-cols-[3fr,2fr] gap-6">
        <div class="space-y-4">
            @if(!empty($cart))
                <div class="surface-card border border-green-50 p-4">
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Bicicletas</h3>
                    @foreach($bicicletas as $bici)
                        <div class="flex items-center border-b last:border-b-0 border-gray-100 py-3">
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
                                    <button class="text-[11px] text-green-700 font-semibold">Actualizar</button>
                                </form>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-600">Subtotal</p>
                                <p class="text-sm font-semibold text-green-700">
                                    S/ {{ number_format($bici->precio_venta * $cart[$bici->id], 2) }}
                                </p>
                                <form action="{{ route('cart.remove', $bici->id) }}" method="POST" class="mt-1">
                                    @csrf
                                    <button class="text-[11px] text-red-600 font-semibold">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(!empty($cartAccessories))
                <div class="surface-card border border-blue-50 p-4">
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Accesorios</h3>
                    @foreach($accesories as $acc)
                        <div class="flex items-center border-b last:border-b-0 border-gray-100 py-3">
                            @php
                                $fotoAcc = null;
                                if ($acc->foto) {
                                    $fotoAcc = \Illuminate\Support\Facades\Storage::disk('public')->exists($acc->foto)
                                        ? \Illuminate\Support\Facades\Storage::url($acc->foto)
                                        : (\Illuminate\Support\Str::startsWith($acc->foto, ['http','https','/'])
                                            ? $acc->foto
                                            : asset($acc->foto));
                                }
                            @endphp
                            <div class="w-16 h-16 rounded-2xl bg-gray-100 overflow-hidden mr-3">
                                @if($fotoAcc)
                                    <img src="{{ $fotoAcc }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">{{ $acc->nombre }}</p>
                                <p class="text-[11px] text-gray-500">Precio: S/ {{ number_format($acc->precio, 2) }}</p>
                                <form action="{{ route('cart.update.accessory', $acc->id) }}" method="POST" class="mt-1 flex items-center space-x-2">
                                    @csrf
                                    <input type="number" name="cantidad" value="{{ $cartAccessories[$acc->id] }}"
                                           class="w-16 text-xs border rounded-lg px-2 py-1">
                                    <button class="text-[11px] text-green-700 font-semibold">Actualizar</button>
                                </form>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-600">Subtotal</p>
                                <p class="text-sm font-semibold text-green-700">
                                    S/ {{ number_format($acc->precio * $cartAccessories[$acc->id], 2) }}
                                </p>
                                <form action="{{ route('cart.remove.accessory', $acc->id) }}" method="POST" class="mt-1">
                                    @csrf
                                    <button class="text-[11px] text-red-600 font-semibold">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="surface-card border border-green-50 p-5 flex flex-col justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-900 mb-3">Resumen</h2>
                <div class="flex justify-between text-xs text-gray-600 mb-2">
                    <span>Subtotal</span>
                    <span>S/ {{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between text-xs text-gray-600 mb-2">
                    <span>Envio</span>
                    <span>Incluido</span>
                </div>
                <div class="border-t border-dashed my-3"></div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-semibold text-gray-700">Total a pagar</span>
                    <span class="text-2xl font-bold text-green-700">S/ {{ number_format($total, 2) }}</span>
                </div>
            </div>

            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4 space-y-4" id="checkout-form">
                @csrf
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-gray-800">Metodo de pago</p>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="metodo_pago" value="tarjeta" checked>
                        <span>Tarjeta</span>
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="metodo_pago" value="yape_plin">
                        <span>Yape / Plin</span>
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="metodo_pago" value="efectivo">
                        <span>Efectivo</span>
                    </label>
                </div>

                <div id="card-fields" class="space-y-3">
                    <div class="form-field">
                        <label>Nombre en la tarjeta</label>
                        <input type="text" name="card_nombre" placeholder="Como aparece en la tarjeta">
                    </div>
                    <div class="form-field">
                        <label>Numero de tarjeta</label>
                        <input type="text" name="card_numero" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="form-field">
                            <label>Expiracion</label>
                            <input type="text" name="card_exp" placeholder="MM/AA">
                        </div>
                        <div class="form-field">
                            <label>CVV</label>
                            <input type="text" name="card_cvv" placeholder="XXX">
                        </div>
                    </div>
                </div>

                <button
                    class="btn-brand w-full justify-center text-sm py-3">
                    Confirmar compra
                </button>
            </form>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('checkout-form');
        if (!form) return;
        const radios = form.querySelectorAll('input[name="metodo_pago"]');
        const cardFields = document.getElementById('card-fields');

        const toggleCard = () => {
            const method = form.querySelector('input[name="metodo_pago"]:checked')?.value;
            if (method === 'tarjeta') {
                cardFields.classList.remove('hidden');
            } else {
                cardFields.classList.add('hidden');
            }
        };

        radios.forEach(r => r.addEventListener('change', toggleCard));
        toggleCard();
    });
</script>
@endsection
