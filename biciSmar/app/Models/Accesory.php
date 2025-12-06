<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria',
        'tag',
        'precio',
        'stock',
        'descripcion',
        'foto',
        'estado',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'accesory_id');
    }
}
