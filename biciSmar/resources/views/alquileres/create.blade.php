@extends('layouts.app')

@section('content')
<div class="max-w-4xl">
    <span class="pill mb-3 inline-flex">Admin</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Nuevo alquiler (admin)</h1>

    <form action="{{ route('admin.alquileres.store') }}" method="POST" class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        <div class="grid md:grid-cols-3 gap-4">
            <div class="form-field">
                <label>Cliente</label>
                <select name="user_id" required>
                    <option value="">Seleccione usuario</option>
                    @foreach($usuarios as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label>Bicicleta</label>
                <select name="bicicleta_id" required>
                    @foreach($bicicletas as $bici)
                        <option value="{{ $bici->id }}" @selected(old('bicicleta_id')==$bici->id)>{{ $bici->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <label>Tipo cliente</label>
                <select name="tipo_cliente">
                    <option value="individual" @selected(old('tipo_cliente')==='individual')>Individual</option>
                    <option value="empresa" @selected(old('tipo_cliente')==='empresa')>Empresa</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="form-field">
                <label>Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
            </div>
            <div class="form-field">
                <label>Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
            </div>
            <div class="form-field">
                <label>Cantidad (corporativo)</label>
                <input type="number" name="cantidad" min="1" value="{{ old('cantidad',1) }}">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Entrega o recoger</label>
                <select name="modo_entrega">
                    <option value="recoger" @selected(old('modo_entrega')==='recoger')>Recoger</option>
                    <option value="entregar" @selected(old('modo_entrega')==='entregar')>Entregar</option>
                </select>
            </div>
            <div class="form-field">
                <label>Dirección (si entrega)</label>
                <input type="text" name="direccion_entrega" value="{{ old('direccion_entrega') }}">
            </div>
        </div>

        <div class="form-field">
            <label>Método de pago</label>
            <select name="metodo_pago">
                <option value="efectivo" @selected(old('metodo_pago')==='efectivo')>Efectivo</option>
                <option value="tarjeta" @selected(old('metodo_pago')==='tarjeta')>Tarjeta</option>
                <option value="yape_plin" @selected(old('metodo_pago')==='yape_plin')>Yape / Plin</option>
            </select>
        </div>

        <div class="form-field">
            <label>Observaciones (opcional)</label>
            <textarea name="observaciones" rows="2">{{ old('observaciones') }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <button class="btn-brand px-5">Guardar</button>
            <a href="{{ route('admin.alquileres.index') }}" class="btn-ghost text-sm">Cancelar</a>
        </div>
    </form>
</div>
@endsection
