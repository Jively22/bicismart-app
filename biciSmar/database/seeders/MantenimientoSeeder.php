<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mantenimiento;

class MantenimientoSeeder extends Seeder
{
    public function run(): void
    {
        // --- Servicios oficiales (internos) ---
        Mantenimiento::create([
            'nombre' => 'Ajuste general de bicicleta',
            'descripcion' => 'Incluye ajuste de frenos, cambios, lubricación y revisión de seguridad.',
            'precio' => 45.00,
            'tipo_servicio' => 'interno',
            'tecnico' => 'BiciSmart - Técnico Certificado',
        ]);

        Mantenimiento::create([
            'nombre' => 'Alineación y centrado de ruedas',
            'descripcion' => 'Corrección del aro, radios y balance de la rueda.',
            'precio' => 35.00,
            'tipo_servicio' => 'interno',
            'tecnico' => 'BiciSmart - Técnico Certificado',
        ]);

        Mantenimiento::create([
            'nombre' => 'Cambio de cadena',
            'descripcion' => 'Instalación de cadena nueva, limpieza y lubricación del sistema.',
            'precio' => 28.00,
            'tipo_servicio' => 'interno',
            'tecnico' => 'BiciSmart - Técnico Senior',
        ]);

        Mantenimiento::create([
            'nombre' => 'Mantenimiento completo premium',
            'descripcion' => 'Servicio completo: frenos, cambios, limpieza profunda, transmisión y ruedas.',
            'precio' => 95.00,
            'tipo_servicio' => 'interno',
            'tecnico' => 'BiciSmart - Especialista Premium',
        ]);

        // --- Servicios ofrecidos por técnicos externos ---
        Mantenimiento::create([
            'nombre' => 'Cambio de llanta / tubo',
            'descripcion' => 'Servicio rápido para pinchazos y desgaste de llantas.',
            'precio' => 18.00,
            'tipo_servicio' => 'externo',
            'tecnico' => 'Juan Pérez Bike Service',
        ]);

        Mantenimiento::create([
            'nombre' => 'Lubricación completa',
            'descripcion' => 'Lubricación de cadena, cables, cambios y pedales.',
            'precio' => 15.00,
            'tipo_servicio' => 'externo',
            'tecnico' => 'Rodrigo Bike Solutions',
        ]);

        Mantenimiento::create([
            'nombre' => 'Diagnóstico y revisión general',
            'descripcion' => 'Evaluación del estado general de la bicicleta con informe de fallas.',
            'precio' => 22.00,
            'tipo_servicio' => 'externo',
            'tecnico' => 'BikeDoctor Perú',
        ]);

        Mantenimiento::create([
            'nombre' => 'Servicio corporativo (por bicicleta)',
            'descripcion' => 'Mantenimiento mensual para flotas empresariales.',
            'precio' => 120.00,
            'tipo_servicio' => 'externo',
            'tecnico' => 'Mobilitex Corporate Mobility',
        ]);
    }
}
