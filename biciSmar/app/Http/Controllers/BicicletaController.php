<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletaController extends Controller
{
    // Catálogo público
    public function catalogo()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->paginate(9);
        return view('bicicletas.catalogo', compact('bicicletas'));
    }

    public function showPublic(Bicicleta $bicicleta)
    {
        return view('bicicletas.show_public', compact('bicicleta'));
    }

    // CRUD Admin
    public function index()
    {
        $bicicletas = Bicicleta::orderBy('id', 'desc')->paginate(15);
        return view('bicicletas.index', compact('bicicletas'));
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:venta,alquiler,mixto',
            'precio_venta' => 'nullable|numeric|min:0',
            'precio_alquiler_hora' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:disponible,no_disponible',
        ]);

        Bicicleta::create($data);

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta creada correctamente.');
    }

    public function edit(Bicicleta $bicicleta)
    {
        return view('bicicletas.edit', compact('bicicleta'));
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:venta,alquiler,mixto',
            'precio_venta' => 'nullable|numeric|min:0',
            'precio_alquiler_hora' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:disponible,no_disponible',
        ]);

        $bicicleta->update($data);

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta actualizada correctamente.');
    }

    public function destroy(Bicicleta $bicicleta)
    {
        // delete simple, cuidando integridad referencial vía ON DELETE RESTRICT o SET NULL
        $bicicleta->delete();

        return redirect()->route('bicicletas.index')
            ->with('success', 'Bicicleta eliminada correctamente.');
    }
}
