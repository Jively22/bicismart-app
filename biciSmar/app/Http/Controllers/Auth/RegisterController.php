<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'tipo_cliente' => 'required|in:individual,empresa',
            'ruc' => 'nullable|string|max:20',
            'nombre_empresa' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo_cliente' => $data['tipo_cliente'],
            'ruc' => $data['tipo_cliente'] === 'empresa' ? $data['ruc'] : null,
            'nombre_empresa' => $data['tipo_cliente'] === 'empresa' ? $data['nombre_empresa'] : null,
            'is_admin' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
