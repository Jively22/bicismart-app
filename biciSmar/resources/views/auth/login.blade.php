@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <p class="text-xs tracking-[0.3em] text-green-700 uppercase mb-2">Bienvenido de nuevo</p>
            <h1 class="text-2xl font-extrabold text-gray-900">Ingresar a BiciSmart</h1>
            <p class="text-xs text-gray-600 mt-1">Accede a tus alquileres, compras y mantenimientos.</p>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-xl border border-gray-100 p-6">
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" required
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="inline-flex items-center space-x-2 text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Recordarme</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full py-2.5 rounded-xl bg-green-700 text-white text-sm font-semibold shadow-md hover:bg-green-800 transition">
                    Ingresar
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-600 mt-4">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-green-700 font-semibold hover:underline">
                Crear una cuenta
            </a>
        </p>
    </div>
</div>
@endsection
