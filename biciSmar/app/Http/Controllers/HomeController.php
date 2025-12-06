<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;

class HomeController extends Controller
{
    public function index()
    {
        $bicicletasTop = Bicicleta::orderByDesc('created_at')->limit(4)->get();
        $bicicletasMini = Bicicleta::orderByDesc('created_at')->limit(6)->get();

        return view('home', compact('bicicletasTop', 'bicicletasMini'));
    }
}
