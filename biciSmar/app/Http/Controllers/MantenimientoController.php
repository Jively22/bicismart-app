<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::orderBy('id', 'desc')->paginate(15);
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function indexPublic()
    {
        $mantenimientos = Mantenimiento::all();
        return view('mantenimientos.public', compact('mantenimientos'));
    }

    public function misMantenimientos()
    {
        // Si en un futuro se relaciona con usuario, aquí se filtraría.
        $mantenimientos = Mantenimiento::orderBy('id', 'desc')->get();
        return view('mantenimientos.mis', compact('mantenimientos'));
    }

    public function create()
    {
        return view('mantenimientos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo_servicio' => 'required|string|max:50',
            'proveedor' => 'nullable|string|max:255',
        ]);

        Mantenimiento::create($data);

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.edit', compact('mantenimiento'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo_servicio' => 'required|string|max:50',
            'proveedor' => 'nullable|string|max:255',
        ]);

        $mantenimiento->update($data);

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio eliminado correctamente.');
    }
}
