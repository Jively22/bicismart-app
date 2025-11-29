@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Carrito de compras</h1>

@if(empty($cart))
    <p class="text-gray-600">Tu carrito está vacío.</p>
@else
    <table class="w-full bg-white rounded shadow overflow-hidden mb-4">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Bicicleta</th>
                <th class="px-4 py-2 text-left">Cantidad</th>
                <th class="px-4 py-2 text-left">Precio</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bicicletas as $bici)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $bici->nombre }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('cart.update', $bici->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="cantidad" value="{{ $cart[$bici->id] }}"
                                   class="border rounded px-2 py-1 w-16">
                            <button class="text-blue-600">Actualizar</button>
                        </form>
                    </td>
                    <td class="px-4 py-2">S/ {{ number_format($bici->precio_venta, 2) }}</td>
                    <td class="px-4 py-2">
                        S/ {{ number_format($bici->precio_venta * $cart[$bici->id], 2) }}
                    </td>
                    <td class="px-4 py-2">
                        <form action="{{ route('cart.remove', $bici->id) }}" method="POST">
                            @csrf
                            <button class="text-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-right text-xl font-bold mb-4">
        Total: S/ {{ number_format($total, 2) }}
    </p>

    <form action="{{ route('cart.checkout') }}" method="POST" class="text-right">
        @csrf
        <button class="bg-green-600 text-white px-6 py-2 rounded">
            Confirmar compra
        </button>
    </form>
@endif
@endsection
