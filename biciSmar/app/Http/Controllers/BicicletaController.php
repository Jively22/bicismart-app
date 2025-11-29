<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BicicletaController extends Controller
{
    public function index()
    {
        $bicicletas = Bicicleta::orderBy('id', 'desc')->paginate(10);
        return view('bicicletas.index', compact('bicicletas'));
    }

    public function catalogo()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('bicicletas.catalogo', compact('bicicletas'));
    }

    public function showPublic(Bicicleta $bicicleta)
    {
        return view('bicicletas.show_public', compact('bicicleta'));
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bicicletas', 'public');
        }

        Bicicleta::create($data);

        return redirect()->route('admin.bicicletas.index')
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
            'tipo' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            if ($bicicleta->foto) {
                Storage::disk('public')->delete($bicicleta->foto);
            }
            $data['foto'] = $request->file('foto')->store('bicicletas', 'public');
        }

        $bicicleta->update($data);

        return redirect()->route('admin.bicicletas.index')
            ->with('success', 'Bicicleta actualizada correctamente.');
    }

    public function destroy(Bicicleta $bicicleta)
    {
        if ($bicicleta->foto) {
            Storage::disk('public')->delete($bicicleta->foto);
        }

        $bicicleta->delete();

        return redirect()->route('admin.bicicletas.index')
            ->with('success', 'Bicicleta eliminada correctamente.');
    }
}
