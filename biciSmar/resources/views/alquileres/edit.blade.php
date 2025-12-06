@extends('layouts.app')

@section('content')
<div class="max-w-4xl">
    <span class="pill mb-3 inline-flex">Editar</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Editar alquiler</h1>

    <form action="{{ route('admin.alquileres.update', $alquiler->id) }}" method="POST" class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-3 gap-4">
            <div class="form-field">
                <label>Cliente</label>
                <select name="user_id" required>
                    @foreach($usuarios as $user)
                        <option value="{{ $user->id }}" @selected($alquiler->user_id==$user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label>Bicicleta</label>
                <select name="bicicleta_id" required>
                    @foreach($bicicletas as $bici)
                        <option value="{{ $bici->id }}" @selected($alquiler->bicicleta_id==$bici->id)>{{ $bici->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label>Tipo cliente</label>
                <select name="tipo_cliente">
                    <option value="individual" @selected($alquiler->tipo_cliente==='individual')>Individual</option>
                    <option value="empresa" @selected($alquiler->tipo_cliente==='empresa')>Empresa</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="form-field">
                <label>Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" value="{{ $alquiler->fecha_inicio }}" required>
            </div>
            <div class="form-field">
                <label>Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" value="{{ $alquiler->fecha_fin }}" required>
            </div>
            <div class="form-field">
                <label>Cantidad (corporativo)</label>
                <input type="number" name="cantidad" min="1" value="{{ $alquiler->cantidad ?? 1 }}">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Entrega o recoger</label>
                <select name="modo_entrega">
                    <option value="recoger" @selected($alquiler->modo_entrega==='recoger')>Recoger</option>
                    <option value="entregar" @selected($alquiler->modo_entrega==='entregar')>Entregar</option>
                </select>
            </div>
            <div class="form-field">
                <label>Dirección (si entrega)</label>
                <input type="text" name="direccion_entrega" value="{{ $alquiler->direccion_entrega }}">
            </div>
        </div>

        <div class="form-field">
            <label>Método de pago</label>
            <select name="metodo_pago">
                <option value="efectivo" @selected($alquiler->metodo_pago==='efectivo')>Efectivo</option>
                <option value="tarjeta" @selected($alquiler->metodo_pago==='tarjeta')>Tarjeta</option>
                <option value="yape_plin" @selected($alquiler->metodo_pago==='yape_plin')>Yape / Plin</option>
            </select>
        </div>

        <div class="form-field">
            <label>Observaciones (opcional)</label>
            <textarea name="observaciones" rows="2">{{ $alquiler->observaciones }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <button class="btn-brand px-5">Actualizar</button>
            <a href="{{ route('admin.alquileres.index') }}" class="btn-ghost text-sm">Cancelar</a>
        </div>
    </form>
</div>
@endsection
