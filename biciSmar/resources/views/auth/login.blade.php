@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <span class="pill inline-flex mb-2">Bienvenido</span>
            <h1 class="text-2xl font-extrabold text-gray-900">Ingresar a BiciSmart</h1>
            <p class="text-xs text-gray-600 mt-1">Accede a tus alquileres, compras y mantenimientos.</p>
        </div>

        <div class="surface-card rounded-3xl border border-green-50 p-6">
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="form-field">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
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

                <button type="submit" class="btn-brand w-full justify-center text-sm">
                    Ingresar
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-600 mt-4">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-green-700 font-semibold">Crear una cuenta</a>
        </p>
    </div>
</div>
@endsection
