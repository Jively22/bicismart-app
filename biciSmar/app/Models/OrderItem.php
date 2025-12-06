<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'bicicleta_id',
        'accesory_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class);
    }

    public function accesory()
    {
        return $this->belongsTo(Accesory::class, 'accesory_id');
    }
}
