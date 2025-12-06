@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-2xl grid md:grid-cols-2 gap-8">
        <div class="hidden md:flex flex-col justify-center space-y-3">
            <span class="pill inline-flex">Crea tu cuenta</span>
            <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                Súmate a la red BiciSmart.
            </h1>
            <p class="text-xs text-gray-600">
                Elige si serás un usuario individual o una empresa con flota corporativa.
                Podrás ver alquileres, compras y mantenimientos desde tu panel.
            </p>
            <ul class="text-xs text-gray-700 space-y-1">
                <li>• Usuarios individuales: alquiler rápido y compras.</li>
                <li>• Empresas: alquiler corporativo y mantenimiento para flotas.</li>
            </ul>
        </div>

        <div>
            <div class="mb-4 text-center md:text-left">
                <h2 class="text-xl font-bold text-gray-900 mb-1">Registro</h2>
                <p class="text-xs text-gray-600">Completa tus datos para comenzar.</p>
            </div>

            <div class="surface-card rounded-3xl border border-green-50 p-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="form-field">
                        <label>Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label>Tipo de usuario</label>
                        <select name="tipo_cliente" required id="tipo-cliente">
                            <option value="individual" {{ old('tipo_cliente') == 'individual' ? 'selected' : '' }}>Individual</option>
                            <option value="empresa" {{ old('tipo_cliente') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                        </select>
                    </div>

                    <div id="empresa-extra" class="{{ old('tipo_cliente') == 'empresa' ? '' : 'hidden' }} space-y-3">
                        <div class="form-field">
                            <label>RUC de la empresa</label>
                            <input type="text" name="ruc" value="{{ old('ruc') }}">
                        </div>
                        <div class="form-field">
                            <label>Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}">
                        </div>
                    </div>

                    <div class="form-field">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="form-field">
                            <label>Contraseña</label>
                            <input type="password" name="password" required>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-field">
                            <label>Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-brand w-full justify-center text-sm">
                        Crear cuenta
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-600 mt-4 md:text-left">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold">Ingresar</a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('tipo-cliente');
        const empresaExtra = document.getElementById('empresa-extra');

        if (select && empresaExtra) {
            select.addEventListener('change', () => {
                if (select.value === 'empresa') {
                    empresaExtra.classList.remove('hidden');
                } else {
                    empresaExtra.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection
