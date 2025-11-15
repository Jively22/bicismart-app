<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletaController extends Controller
{
    public function index()
    {
        $bicicletas = Bicicleta::paginate(10);
        return view('bicicletas.index', compact('bicicletas'));
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|in:montaña,ruta,urbana,eléctrica',
            'precio_venta' => 'nullable|numeric|min:0',
            'precio_alquiler_hora' => 'nullable|numeric|min:0',
        ]);

        Bicicleta::create($request->all());

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta creada exitosamente.');
    }

    public function show(Bicicleta $bicicleta)
    {
        return view('bicicletas.show', compact('bicicleta'));
    }

    public function edit(Bicicleta $bicicleta)
    {
        return view('bicicletas.edit', compact('bicicleta'));
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|in:montaña,ruta,urbana,eléctrica',
            'precio_venta' => 'nullable|numeric|min:0',
            'precio_alquiler_hora' => 'nullable|numeric|min:0',
        ]);

        $bicicleta->update($request->all());

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta actualizada exitosamente.');
    }

    public function destroy(Bicicleta $bicicleta)
    {
        $bicicleta->delete();

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta eliminada exitosamente.');
    }
}