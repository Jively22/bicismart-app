<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bicismart.com'],
            [
                'name' => 'Administrador BiciSmart',
                'password' => Hash::make('password'),
                'tipo_cliente' => 'individual',
                'is_admin' => true,
            ]
        );
    }
}
