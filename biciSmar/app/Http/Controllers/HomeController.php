<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;

class HomeController extends Controller
{
    public function index()
    {
        $destacadas = Bicicleta::where('estado', 'disponible')->take(6)->get();

        return view('home', compact('destacadas'));
    }
}
