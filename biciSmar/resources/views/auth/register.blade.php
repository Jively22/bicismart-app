@extends('layouts.app')

@section('title','Registrarse')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="fw-bold text-success mb-4 text-center">Crear cuenta</h2>

                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de usuario</label>
                            <select name="tipo_cliente" id="tipo_cliente" class="form-select" required>
                                <option value="individual" {{ old('tipo_cliente')=='individual'?'selected':'' }}>Individual</option>
                                <option value="empresa" {{ old('tipo_cliente')=='empresa'?'selected':'' }}>Empresa</option>
                            </select>
                        </div>

                        <div id="empresa-fields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">RUC</label>
                                <input type="text" name="ruc" value="{{ old('ruc') }}" class="form-control">
                                @error('ruc')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre de la empresa</label>
                                <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}" class="form-control">
                                @error('nombre_empresa')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
                    </form>

                    @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const tipoSelect = document.getElementById('tipo_cliente');
                            const empresaFields = document.getElementById('empresa-fields');

                            function toggleEmpresaFields() {
                                if (tipoSelect.value === 'empresa') {
                                    empresaFields.style.display = 'block';
                                } else {
                                    empresaFields.style.display = 'none';
                                }
                            }

                            tipoSelect.addEventListener('change', toggleEmpresaFields);
                            toggleEmpresaFields();
                        });
                    </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
