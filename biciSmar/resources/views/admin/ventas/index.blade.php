@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Ventas</span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Historial de ventas</h1>
    <p class="text-sm text-gray-600">Detalle de pedidos registrados desde el checkout.</p>
</div>

<div class="table-shell bg-white/90">
    <table class="text-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Items</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                    <td class="font-semibold text-green-700">S/ {{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->items->count() }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.ventas.show', $order) }}" class="btn-ghost text-xs px-3">Ver detalle</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-slate-500">
                        Aún no hay ventas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">
        {{ $orders->links() }}
    </div>
</div>
@endsection
