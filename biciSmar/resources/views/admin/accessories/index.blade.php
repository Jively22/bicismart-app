@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Administrar</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Accesorios</h1>
        <p class="text-sm text-gray-600">Partes, repuestos y merch.</p>
    </div>
    <a href="{{ route('admin.accesories.create') }}" class="btn-brand text-sm px-4">+ Nuevo accesorio</a>
</div>

<div class="table-shell bg-white/90">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr class="border-b border-green-50">
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}" class="w-14 h-14 object-cover rounded-lg border">
                        @else
                            <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center text-[10px] text-gray-500">Sin foto</div>
                        @endif
                    </td>
                    <td class="text-sm font-semibold text-gray-900">{{ $item->nombre }}</td>
                    <td class="text-sm text-gray-700">{{ ucfirst($item->categoria ?? 'N/A') }}</td>
                    <td class="text-sm text-gray-700">{{ $item->tag ?? 'oficial' }}</td>
                    <td class="text-sm text-gray-700">S/ {{ number_format($item->precio, 2) }}</td>
                    <td class="text-sm text-gray-700">{{ $item->stock }}</td>
                    <td class="text-sm text-gray-700">{{ ucfirst($item->estado) }}</td>
                    <td class="text-sm text-gray-700 space-x-2">
                        <a href="{{ route('admin.accesories.edit', $item) }}" class="text-green-700 font-semibold">Editar</a>
                        <form action="{{ route('admin.accesories.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 font-semibold" onclick="return confirm('¿Eliminar accesorio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection
