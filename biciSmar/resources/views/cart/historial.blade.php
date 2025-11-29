@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Historial de compras</h1>

@forelse($orders as $order)
    <div class="bg-white rounded shadow mb-4 p-4">
        <div class="flex justify-between mb-2">
            <span class="font-semibold">Pedido #{{ $order->id }}</span>
            <span class="text-gray-600">{{ $order->created_at }}</span>
        </div>
        <table class="w-full text-sm mb-2">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 py-1 text-left">Bicicleta</th>
                    <th class="px-2 py-1 text-left">Cantidad</th>
                    <th class="px-2 py-1 text-left">P. unitario</th>
                    <th class="px-2 py-1 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td class="px-2 py-1">{{ $item->bicicleta->nombre ?? 'N/A' }}</td>
                        <td class="px-2 py-1">{{ $item->cantidad }}</td>
                        <td class="px-2 py-1">S/ {{ number_format($item->precio_unitario, 2) }}</td>
                        <td class="px-2 py-1">S/ {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-right font-bold">
            Total: S/ {{ number_format($order->total, 2) }}
        </p>
    </div>
@empty
    <p class="text-gray-600">Aún no tienes compras registradas.</p>
@endforelse
@endsection
