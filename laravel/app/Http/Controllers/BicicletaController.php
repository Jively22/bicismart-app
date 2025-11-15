<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bicicletas = Bicicleta::all();
        return view('bicicletas.index', compact('bicicletas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bicicletas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
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

    /**
     * Display the specified resource.
     */
    public function show(Bicicleta $bicicleta)
    {
        return view('bicicletas.show', compact('bicicleta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bicicleta $bicicleta)
    {
        return view('bicicletas.edit', compact('bicicleta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bicicleta $bicicleta)
    {
        // Validación
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bicicleta $bicicleta)
    {
        $bicicleta->delete();

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta eliminada exitosamente.');
    }
}