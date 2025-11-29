<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
        'precio_venta',
        'precio_alquiler_hora',
        'stock',
        'estado',
        'foto',
    ];

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
