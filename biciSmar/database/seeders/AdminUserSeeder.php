<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@bicismart.com')->exists()) {
            User::create([
                'name' => 'Administrador BiciSmart',
                'email' => 'admin@bicismart.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'tipo_cliente' => 'empresa',
                'ruc' => '20123456789',
                'nombre_empresa' => 'BiciSmart Corp',
            ]);
        }
    }
}
