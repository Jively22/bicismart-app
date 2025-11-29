<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlquilerController extends Controller
{
    // Admin: listado completo
    public function index()
    {
        $alquileres = Alquiler::with(['bicicleta', 'usuario'])->orderBy('id', 'desc')->get();
        return view('alquileres.index', compact('alquileres'));
    }

    // Formulario genérico admin
    public function create()
    {
        $bicicletas = Bicicleta::all();
        return view('alquileres.create', compact('bicicletas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:individual,corporativo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'precio_total' => 'required|numeric',
        ]);

        if (!$data['user_id']) {
            $data['user_id'] = Auth::id();
        }

        Alquiler::create($data);

        return redirect()->route('alquileres.index')->with('success', 'Alquiler registrado correctamente.');
    }

    public function edit($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        $bicicletas = Bicicleta::all();
        return view('alquileres.edit', compact('alquiler', 'bicicletas'));
    }

    public function update(Request $request, $id)
    {
        $alquiler = Alquiler::findOrFail($id);

        $data = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:individual,corporativo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'precio_total' => 'required|numeric',
        ]);

        $alquiler->update($data);

        return redirect()->route('alquileres.index')->with('success', 'Alquiler actualizado correctamente.');
    }

    public function destroy($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        $alquiler->delete();

        return redirect()->route('alquileres.index')->with('success', 'Alquiler eliminado correctamente.');
    }

    // FLUJO PARA USUARIOS

    // Vista de mis alquileres (según perfil)
    public function misAlquileres()
    {
        $user = Auth::user();

        $query = Alquiler::with('bicicleta')->where('user_id', $user->id);

        if ($user->tipo_cliente === 'individual') {
            $query->where('tipo', 'individual');
        } elseif ($user->tipo_cliente === 'empresa') {
            $query->where('tipo', 'corporativo');
        }

        $alquileres = $query->orderBy('id', 'desc')->get();

        return view('alquileres.mis', compact('alquileres', 'user'));
    }

    // Formulario alquiler individual
    public function createIndividual()
    {
        $user = Auth::user();
        abort_if($user->tipo_cliente !== 'individual', 403, 'Solo clientes individuales pueden usar este formulario.');

        $bicicletas = Bicicleta::whereIn('tipo', ['alquiler', 'mixto'])->get();
        return view('alquileres.create_individual', compact('bicicletas'));
    }

    // Formulario alquiler corporativo
    public function createCorporativo()
    {
        $user = Auth::user();
        abort_if($user->tipo_cliente !== 'empresa', 403, 'Solo cuentas empresa pueden usar este formulario.');

        $bicicletas = Bicicleta::whereIn('tipo', ['alquiler', 'mixto'])->get();
        return view('alquileres.create_corporativo', compact('bicicletas'));
    }

    public function storeIndividual(Request $request)
    {
        $user = Auth::user();
        abort_if($user->tipo_cliente !== 'individual', 403);

        $data = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'precio_total' => 'required|numeric',
        ]);

        $data['user_id'] = $user->id;
        $data['tipo'] = 'individual';

        Alquiler::create($data);

        return redirect()->route('alquileres.mis')->with('success', 'Alquiler individual registrado.');
    }

    public function storeCorporativo(Request $request)
    {
        $user = Auth::user();
        abort_if($user->tipo_cliente !== 'empresa', 403);

        $data = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'precio_total' => 'required|numeric',
        ]);

        $data['user_id'] = $user->id;
        $data['tipo'] = 'corporativo';

        Alquiler::create($data);

        return redirect()->route('alquileres.mis')->with('success', 'Alquiler corporativo registrado.');
    }
}
