<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;

class CatalogoController extends Controller
{
    public function index()
    {
        $bicicletas = Bicicleta::orderBy('created_at', 'desc')->paginate(9);

        return view('catalogo.index', compact('bicicletas'));
    }
}