@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Historial de compras</h1>

@forelse($orders as $order)
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 mb-4 p-4">
        <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
            <span>Pedido #{{ $order->id }}</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <table class="w-full text-[11px] mb-2">
            <thead class="bg-gray-50">
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
        <p class="text-right text-xs font-semibold text-green-700">
            Total: S/ {{ number_format($order->total, 2) }}
        </p>
    </div>
@empty
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-6 text-center">
        <p class="text-sm text-gray-700 mb-2">Aún no tienes compras registradas.</p>
        <a href="{{ route('bicicletas.catalogo') }}" class="text-sm text-green-700 font-semibold hover:underline">
            Ver catálogo
        </a>
    </div>
@endforelse
@endsection
