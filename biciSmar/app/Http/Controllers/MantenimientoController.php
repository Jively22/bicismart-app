<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\MantenimientoSolicitud;
use App\Models\Bicicleta;
use App\Models\SolicitudCorporativa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function solicitarForm(Mantenimiento $mantenimiento)
    {
        $user = auth()->user();
        $bicicletasUser = collect();
        $flotas = collect();

        if ($user) {
            $bicicletasCompradas = Bicicleta::whereHas('orderItems.order', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();

            $bicicletasAlquiladas = Bicicleta::whereHas('alquileres', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();

            $bicicletasUser = $bicicletasCompradas->merge($bicicletasAlquiladas)->unique('id');

            if ($user->tipo_cliente === 'empresa') {
                $flotas = SolicitudCorporativa::where('user_id', $user->id)->orderByDesc('id')->get();
            }
        }

        return view('mantenimientos.solicitar', compact('mantenimiento', 'bicicletasUser', 'flotas', 'user'));
    }

    public function enviarSolicitud(Request $request, Mantenimiento $mantenimiento)
    {
        if (!$request->user()) {
            abort(403);
        }

        $user = $request->user();

        $rules = [
            'descripcion'  => 'required|string|max:500',
            'metodo_pago'  => ['required', Rule::in(['tarjeta', 'yape_plin', 'efectivo'])],
            'card_nombre'  => 'required_if:metodo_pago,tarjeta|string|max:191',
            'card_numero'  => 'required_if:metodo_pago,tarjeta|string|max:25',
            'card_exp'     => 'required_if:metodo_pago,tarjeta|string|max:10',
            'card_cvv'     => 'required_if:metodo_pago,tarjeta|string|max:10',
        ];

        if ($user->tipo_cliente === 'empresa') {
            $rules['metodo_pago'] = ['required', Rule::in(['tarjeta', 'efectivo'])];
            $rules['flota_id'] = 'required|exists:solicitudes_corporativas,id';
            $rules['cantidad'] = 'required|integer|min:1';
        } else {
            $rules['bicicleta_id'] = 'required|exists:bicicletas,id';
            $rules['cantidad'] = 'sometimes|integer|min:1';
        }

        $data = $request->validate($rules);

        $tipoObjetivo = $user->tipo_cliente === 'empresa' ? 'flota' : 'bicicleta';
        $nombreObjetivo = $tipoObjetivo === 'flota'
            ? 'Flota #' . $request->flota_id
            : 'Bicicleta #' . $request->bicicleta_id;

        $cantidad = $tipoObjetivo === 'flota'
            ? (int) $request->cantidad
            : (int) ($request->cantidad ?? 1);

        $pago = $request->metodo_pago;
        $pagoDetalle = $pago;
        if ($pago === 'tarjeta' && $request->card_numero) {
            $last4 = substr(preg_replace('/\D/', '', $request->card_numero), -4);
            $pagoDetalle = "tarjeta ****{$last4}";
        }

        $notas = "Descripcion: {$request->descripcion} | Metodo pago: {$pagoDetalle}";

        MantenimientoSolicitud::create([
            'user_id'          => $user->id,
            'mantenimiento_id' => $mantenimiento->id,
            'tipo_objetivo'    => $tipoObjetivo,
            'nombre_objetivo'  => $nombreObjetivo,
            'cantidad'         => $cantidad,
            'notas'            => $notas,
        ]);

        return redirect()->route('mantenimientos.public')
            ->with('success', 'Solicitud de mantenimiento registrada correctamente.');
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

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio creado correctamente.');
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

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio eliminado correctamente.');
    }
}
