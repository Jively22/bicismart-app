<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BicicletaController extends Controller
{
    // Catálogo público
    public function catalogo()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('bicicletas.catalogo', compact('bicicletas'));
    }

    public function showPublic(Bicicleta $bicicleta)
    {
        return view('bicicletas.show_public', compact('bicicleta'));
    }

    // CRUD admin
    public function index()
    {
        $bicicletas = Bicicleta::orderBy('id', 'desc')->get();
        return view('bicicletas.index', compact('bicicletas'));
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required|in:venta,alquiler,mixto',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable',
            'estado' => 'required',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/bicicletas', 'public');
        }

        Bicicleta::create($data);

        return redirect()->route('bicicletas.index')->with('success', 'Bicicleta creada correctamente.');
    }

    public function edit($id)
    {
        $bicicleta = Bicicleta::findOrFail($id);
        return view('bicicletas.edit', compact('bicicleta'));
    }

    public function update(Request $request, $id)
    {
        $bicicleta = Bicicleta::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required|in:venta,alquiler,mixto',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable',
            'estado' => 'required',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            if ($bicicleta->foto && Storage::disk('public')->exists($bicicleta->foto)) {
                Storage::disk('public')->delete($bicicleta->foto);
            }
            $data['foto'] = $request->file('foto')->store('images/bicicletas', 'public');
        }

        $bicicleta->update($data);

        return redirect()->route('bicicletas.index')->with('success', 'Bicicleta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $bicicleta = Bicicleta::findOrFail($id);
        $bicicleta->delete();

        return redirect()->route('bicicletas.index')->with('success', 'Bicicleta eliminada correctamente.');
    }
}
