<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;

class HomeController extends Controller
{
    public function index()
    {
        $bicicletas = Bicicleta::limit(3)->get();

        return view('home', compact('bicicletas'));
    }
}
