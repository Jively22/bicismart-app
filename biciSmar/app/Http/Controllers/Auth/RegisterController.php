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
        $rules = [
            'name' => 'required|string|max:255',
            'tipo_cliente' => 'required|in:individual,empresa',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ];

        if ($request->input('tipo_cliente') === 'empresa') {
            $rules['ruc'] = 'required|string|max:11';
            $rules['nombre_empresa'] = 'required|string|max:255';
        }

        $data = $request->validate($rules);

        $user = User::create([
            'name' => $data['name'],
            'tipo_cliente' => $data['tipo_cliente'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'cliente',
            'ruc' => $data['ruc'] ?? null,
            'nombre_empresa' => $data['nombre_empresa'] ?? null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registro exitoso. Bienvenido a BiciSmart.');
    }
}
