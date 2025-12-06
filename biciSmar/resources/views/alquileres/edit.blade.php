@extends('layouts.app')

@section('title','Editar alquiler')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Editar alquiler</h1>

    <form action="{{ route('admin.alquileres.update', $alquiler->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Cliente</label>
                <select name="user_id" class="form-select" required>
                    @foreach($usuarios as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $alquiler->user_id)==$user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bicicleta</label>
                <select name="bicicleta_id" class="form-select" required>
                    @foreach($bicicletas as $bici)
                        <option value="{{ $bici->id }}" @selected(old('bicicleta_id', $alquiler->bicicleta_id)==$bici->id)>
                            {{ $bici->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo cliente</label>
                <select name="tipo_cliente" class="form-select">
                    <option value="individual" @selected(old('tipo_cliente', $alquiler->tipo_cliente)==='individual')>Individual</option>
                    <option value="empresa" @selected(old('tipo_cliente', $alquiler->tipo_cliente)==='empresa')>Empresa</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" class="form-control"
                       value="{{ old('fecha_inicio', $alquiler->fecha_inicio) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" class="form-control"
                       value="{{ old('fecha_fin', $alquiler->fecha_fin) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cantidad (corporativo)</label>
                <input type="number" name="cantidad" min="1" value="{{ old('cantidad', $alquiler->cantidad ?? 1) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Entrega o recoger</label>
                <select name="modo_entrega" class="form-select">
                    <option value="recoger" @selected(old('modo_entrega', $alquiler->modo_entrega)==='recoger')>Recoger</option>
                    <option value="entregar" @selected(old('modo_entrega', $alquiler->modo_entrega)==='entregar')>Entregar</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label">Dirección (si entrega)</label>
                <input type="text" name="direccion_entrega" class="form-control" value="{{ old('direccion_entrega', $alquiler->direccion_entrega) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Método de pago</label>
                <select name="metodo_pago" class="form-select">
                    <option value="efectivo" @selected(old('metodo_pago', $alquiler->metodo_pago)==='efectivo')>Efectivo</option>
                    <option value="tarjeta" @selected(old('metodo_pago', $alquiler->metodo_pago)==='tarjeta')>Tarjeta</option>
                    <option value="yape_plin" @selected(old('metodo_pago', $alquiler->metodo_pago)==='yape_plin')>Yape / Plin</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Observaciones (opcional)</label>
                <textarea name="observaciones" class="form-control" rows="2">{{ old('observaciones', $alquiler->observaciones) }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.alquileres.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
