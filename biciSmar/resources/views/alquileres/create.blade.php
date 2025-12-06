@extends('layouts.app')

@section('title','Nuevo alquiler')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Nuevo alquiler (admin)</h1>

    <form action="{{ route('admin.alquileres.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Cliente</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Seleccione usuario</option>
                    @foreach($usuarios as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bicicleta</label>
                <select name="bicicleta_id" class="form-select" required>
                    @foreach($bicicletas as $bici)
                        <option value="{{ $bici->id }}" @selected(old('bicicleta_id')==$bici->id)>{{ $bici->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo cliente</label>
                <select name="tipo_cliente" class="form-select">
                    <option value="individual" @selected(old('tipo_cliente')==='individual')>Individual</option>
                    <option value="empresa" @selected(old('tipo_cliente')==='empresa')>Empresa</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cantidad (corporativo)</label>
                <input type="number" name="cantidad" min="1" value="{{ old('cantidad',1) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Entrega o recoger</label>
                <select name="modo_entrega" class="form-select">
                    <option value="recoger" @selected(old('modo_entrega')==='recoger')>Recoger</option>
                    <option value="entregar" @selected(old('modo_entrega')==='entregar')>Entregar</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label">Dirección (si entrega)</label>
                <input type="text" name="direccion_entrega" class="form-control" value="{{ old('direccion_entrega') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Método de pago</label>
                <select name="metodo_pago" class="form-select">
                    <option value="efectivo" @selected(old('metodo_pago')==='efectivo')>Efectivo</option>
                    <option value="tarjeta" @selected(old('metodo_pago')==='tarjeta')>Tarjeta</option>
                    <option value="yape_plin" @selected(old('metodo_pago')==='yape_plin')>Yape / Plin</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Observaciones (opcional)</label>
                <textarea name="observaciones" class="form-control" rows="2">{{ old('observaciones') }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('admin.alquileres.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
