<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accesory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccesoryController extends Controller
{
    public function index()
    {
        $items = Accesory::orderByDesc('id')->paginate(20);
        return view('admin.accessories.index', compact('items'));
    }

    public function create()
    {
        return view('admin.accessories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:50',
            'tag' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('accesories', 'public');
        }

        Accesory::create($data);

        return redirect()->route('admin.accesories.index')->with('success', 'Accesorio creado');
    }

    public function edit(Accesory $accesory)
    {
        return view('admin.accessories.edit', compact('accesory'));
    }

    public function update(Request $request, Accesory $accesory)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:50',
            'tag' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            if ($accesory->foto) {
                Storage::disk('public')->delete($accesory->foto);
            }
            $data['foto'] = $request->file('foto')->store('accesories', 'public');
        }

        $accesory->update($data);

        return redirect()->route('admin.accesories.index')->with('success', 'Accesorio actualizado');
    }

    public function destroy(Accesory $accesory)
    {
        if ($accesory->foto) {
            Storage::disk('public')->delete($accesory->foto);
        }
        $accesory->delete();

        return redirect()->route('admin.accesories.index')->with('success', 'Accesorio eliminado');
    }
}
