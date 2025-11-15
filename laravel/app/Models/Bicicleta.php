<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $table = 'bicicletas';

    protected $fillable = [
        'marca',
        'modelo',
        'tipo',
        'tamaño',
        'estado',
        'precio_venta',
        'precio_alquiler_hora',
        'precio_alquiler_dia',
        'imagen',
        'descripcion',
        'disponible_para_venta',
        'disponible_para_alquiler'
    ];

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'bicicleta_id');
    }
    
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'bicicleta_id');
    }

    public function ultimoMantenimiento()
    {
        return $this->hasOne(Mantenimiento::class, 'bicicleta_id')->latest('fecha_mantenimiento');
    }

    public function mantenimientosPendientes()
    {
        return $this->hasMany(Mantenimiento::class, 'bicicleta_id')->where('estado', 'pendiente');
    }
}