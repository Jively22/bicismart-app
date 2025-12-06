@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Historial</span>
    <h1 class="text-3xl font-extrabold text-gray-900">Historial de compras</h1>
    <p class="text-sm text-gray-600">Revisa tus pedidos confirmados y sus detalles.</p>
</div>

@forelse($orders as $order)
    <div class="surface-card border border-green-50 mb-4 p-4">
        <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
            <span>Pedido #{{ $order->id }}</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="table-shell border border-green-50">
            <table class="text-[11px]">
                <thead>
                    <tr>
                        <th class="text-left">Producto</th>
                        <th class="text-left">Cantidad</th>
                        <th class="text-left">P. unitario</th>
                        <th class="text-left">Subtotal</th>
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
                            <td>S/ {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-right text-xs font-semibold text-green-700 mt-2">
            Total: S/ {{ number_format($order->total, 2) }}
        </p>
    </div>
@empty
    <div class="surface-card border border-green-50 p-6 text-center">
        <p class="text-sm text-gray-700 mb-2">Aún no tienes compras registradas.</p>
        <a href="{{ route('bicicletas.catalogo') }}" class="btn-brand text-sm px-4">
            Ver catálogo
        </a>
    </div>
@endforelse
@endsection
