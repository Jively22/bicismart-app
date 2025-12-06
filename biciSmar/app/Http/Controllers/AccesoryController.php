<?php

namespace App\Http\Controllers;

use App\Models\Accesory;
use Illuminate\Http\Request;

class AccesoryController extends Controller
{
    public function index(Request $request)
    {
        $items = Accesory::where('estado', 'disponible')->orderByDesc('id')->get();

        if ($request->filled('categoria')) {
            $items = $items->where('categoria', $request->categoria);
        }

        if ($request->filled('tag')) {
            $items = $items->where('tag', $request->tag);
        }

        if ($request->filled('precio_max')) {
            $items = $items->where('precio', '<=', $request->precio_max);
        }

        return view('parts.index', ['items' => $items]);
    }

    public function show(Accesory $accesory)
    {
        return view('parts.show', compact('accesory'));
    }
}
