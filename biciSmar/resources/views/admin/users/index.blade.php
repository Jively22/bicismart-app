@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Usuarios</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Usuarios registrados</h1>
        <p class="text-sm text-gray-600">Lista de cuentas con fecha de registro.</p>
    </div>
</div>

<div class="table-shell bg-white/90">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>RUC</th>
                <th>Empresa</th>
                <th>Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b border-green-50">
                    <td class="text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                    <td class="text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="text-sm text-gray-700">{{ $user->tipo_cliente ?? 'N/A' }}</td>
                    <td class="text-sm text-gray-700">{{ $user->ruc ?? '-' }}</td>
                    <td class="text-sm text-gray-700">{{ $user->nombre_empresa ?? '-' }}</td>
                    <td class="text-sm text-gray-700">{{ $user->created_at?->format('d/m/Y') }}</td>
                    <td class="text-sm text-gray-700 space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-green-700 font-semibold">Editar</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 font-semibold" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection
