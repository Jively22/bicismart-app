@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-2xl grid md:grid-cols-2 gap-8">
        <div class="hidden md:flex flex-col justify-center space-y-3">
            <p class="text-xs tracking-[0.3em] text-green-700 uppercase">Crea tu cuenta</p>
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

            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-xl border border-gray-100 p-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50" required>
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tipo de usuario</label>
                        <select name="tipo_cliente" required
                                class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="individual" {{ old('tipo_cliente') == 'individual' ? 'selected' : '' }}>Individual</option>
                            <option value="empresa" {{ old('tipo_cliente') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                        </select>
                    </div>

                    <div id="empresa-extra" class="{{ old('tipo_cliente') == 'empresa' ? '' : 'hidden' }} space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">RUC de la empresa</label>
                            <input type="text" name="ruc" value="{{ old('ruc') }}"
                                   class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}"
                                   class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Contraseña</label>
                            <input type="password" name="password" required
                                   class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50">
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-green-700 text-white text-sm font-semibold shadow-md hover:bg-green-800 transition">
                        Crear cuenta
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-600 mt-4 md:text-left">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">Ingresar</a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const select = document.querySelector('select[name="tipo_cliente"]');
        const empresaExtra = document.getElementById('empresa-extra');

        if (select) {
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
