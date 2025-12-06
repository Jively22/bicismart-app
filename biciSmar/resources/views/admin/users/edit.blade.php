@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Editar usuario</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Actualizar datos</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="form-field">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-field">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Tipo de usuario</label>
                <select name="tipo_cliente">
                    <option value="">N/A</option>
                    <option value="individual" @selected($user->tipo_cliente==='individual')>Individual</option>
                    <option value="empresa" @selected($user->tipo_cliente==='empresa')>Empresa</option>
                </select>
            </div>
            <div class="form-field">
                <label>RUC</label>
                <input type="text" name="ruc" value="{{ $user->ruc }}">
            </div>
        </div>

        <div class="form-field">
            <label>Nombre de la empresa</label>
            <input type="text" name="nombre_empresa" value="{{ $user->nombre_empresa }}">
        </div>

        <button class="btn-brand px-5">Guardar cambios</button>
    </form>
</div>
@endsection
