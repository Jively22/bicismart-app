<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $table = 'alquileres';

    protected $fillable = [
        'user_id',
        'bicicleta_id',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'precio_total',
    ];

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
