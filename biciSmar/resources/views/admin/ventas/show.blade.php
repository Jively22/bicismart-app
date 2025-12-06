@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.ventas.index') }}" class="text-sm text-emerald-700">&larr; Volver a ventas</a>
    <h1 class="text-3xl font-extrabold text-gray-900 mt-2">Venta #{{ $order->id }}</h1>
    <p class="text-sm text-gray-600">Registrada el {{ $order->created_at?->format('d/m/Y H:i') }}</p>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs uppercase text-gray-500">Cliente</p>
        <p class="text-lg font-bold text-gray-900">{{ $order->user->name ?? 'N/A' }}</p>
        <p class="text-sm text-gray-600">{{ $order->user->email ?? '' }}</p>
    </div>
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs uppercase text-gray-500">Total</p>
        <p class="text-2xl font-bold text-green-700">S/ {{ number_format($order->total, 2) }}</p>
    </div>
</div>

<div class="table-shell bg-white/90">
    <table class="text-sm">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>P. unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        @if($item->bicicleta)
                            {{ $item->bicicleta->nombre }}
                        @elseif($item->accesory)
                            {{ $item->accesory->nombre }} (Accesorio)
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $item->cantidad }}</td>
                    <td>S/ {{ number_format($item->precio_unitario, 2) }}</td>
                    <td class="font-semibold text-green-700">S/ {{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
