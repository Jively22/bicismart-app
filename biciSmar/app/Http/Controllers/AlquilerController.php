<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use App\Models\User;
use App\Models\SolicitudCorporativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlquilerController extends Controller
{
    // ADMIN: ver todos los alquileres
    public function index()
    {
        $alquileres = Alquiler::with(['usuario', 'bicicleta'])
            ->orderBy('id', 'desc')
            ->paginate(15);

        $solicitudesCorporativas = SolicitudCorporativa::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('alquileres.index', compact('alquileres', 'solicitudesCorporativas'));
    }

    // ADMIN: historial compacto (todas las solicitudes)
    public function historialAdmin()
    {
        $alquileres = Alquiler::with(['usuario', 'bicicleta'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('alquileres.historial_admin', compact('alquileres'));
    }

    // ADMIN: formulario crear
    public function create()
    {
        $usuarios = User::orderBy('name')->get();
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();

        return view('alquileres.create', compact('usuarios', 'bicicletas'));
    }

    // ADMIN: guardar
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo_cliente' => 'required|in:individual,empresa',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
            'cantidad' => 'nullable|integer|min:1',
            'modo_entrega' => 'required|in:recoger,entregar',
            'direccion_entrega' => 'nullable|string|max:255',
            'metodo_pago' => 'required|in:efectivo,tarjeta,yape_plin',
            'observaciones' => 'nullable|string',
        ]);

        $bicicleta = Bicicleta::findOrFail($data['bicicleta_id']);
        $precio = $this->calcularPrecio($data['fecha_inicio'], $data['fecha_fin'], $bicicleta->precio_alquiler_hora, $data['cantidad'] ?? 1);

        Alquiler::create([
            'user_id'       => $data['user_id'],
            'bicicleta_id'  => $data['bicicleta_id'],
            'fecha_inicio'  => $data['fecha_inicio'],
            'fecha_fin'     => $data['fecha_fin'],
            'cantidad'      => $data['cantidad'] ?? 1,
            'modo_entrega'  => $data['modo_entrega'],
            'direccion_entrega' => $data['modo_entrega'] === 'entregar' ? ($data['direccion_entrega'] ?? null) : null,
            'metodo_pago'   => $data['metodo_pago'],
            'precio_total'  => $precio,
            'tipo_cliente'  => $data['tipo_cliente'],
            'observaciones' => $data['observaciones'] ?? null,
        ]);

        return redirect()->route('admin.alquileres.index')->with('success', 'Alquiler creado correctamente.');
    }

    // USUARIO: ver sus propios alquileres
    public function misAlquileres()
    {
        $user = Auth::user();

        $alquileres = Alquiler::with('bicicleta')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('alquileres.mis', compact('alquileres'));
    }

    // FORMULARIO INDIVIDUAL
    public function createIndividual()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('alquileres.create_individual', compact('bicicletas'));
    }

    // GUARDAR ALQUILER INDIVIDUAL CON PRECIO AUTOMÁTICO
    public function storeIndividual(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
            'modo_entrega' => 'required|in:recoger,entregar',
            'direccion_entrega' => 'nullable|string|max:255',
            'metodo_pago' => 'required|in:efectivo,tarjeta,yape_plin',
        ]);

        // Obtener bicicleta
        $bicicleta = Bicicleta::findOrFail($request->bicicleta_id);

        // Calcular horas
        $inicio = Carbon::parse($request->fecha_inicio);
        $fin = Carbon::parse($request->fecha_fin);
        $horas = $fin->diffInHours($inicio);

        if ($horas < 1) $horas = 1; // mínimo 1 hora

        // Calcular precio
        $precioTotal = $horas * $bicicleta->precio_alquiler_hora;

        Alquiler::create([
            'user_id'       => $user->id,
            'bicicleta_id'  => $request->bicicleta_id,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'cantidad'      => 1,
            'modo_entrega'  => $request->modo_entrega,
            'direccion_entrega' => $request->modo_entrega === 'entregar' ? $request->direccion_entrega : null,
            'metodo_pago'   => $request->metodo_pago,
            'precio_total'  => $precioTotal,
            'tipo_cliente'  => 'individual',
        ]);

        return redirect()->route('alquileres.mis')
            ->with('success', 'Alquiler registrado correctamente.');
    }

    // FORMULARIO CORPORATIVO
    public function createCorporativo()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('alquileres.create_corporativo', compact('bicicletas'));
    }

    // GUARDAR ALQUILER CORPORATIVO CON PRECIO AUTOMÁTICO
    public function storeCorporativo(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
            'cantidad' => 'required|integer|min:1',
            'modo_entrega' => 'required|in:recoger,entregar',
            'direccion_entrega' => 'nullable|string|max:255',
            'metodo_pago' => 'required|in:efectivo,tarjeta,yape_plin',
        ]);

        // Obtener bicicleta
        $bicicleta = Bicicleta::findOrFail($request->bicicleta_id);

        // Calcular horas
        $inicio = Carbon::parse($request->fecha_inicio);
        $fin = Carbon::parse($request->fecha_fin);
        $horas = $fin->diffInHours($inicio);

        if ($horas < 1) $horas = 1;

        // Precio automático
        $precioTotal = $horas * $bicicleta->precio_alquiler_hora * $request->cantidad;

        Alquiler::create([
            'user_id'       => $user->id,
            'bicicleta_id'  => $request->bicicleta_id,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'cantidad'      => $request->cantidad,
            'modo_entrega'  => $request->modo_entrega,
            'direccion_entrega' => $request->modo_entrega === 'entregar' ? $request->direccion_entrega : null,
            'metodo_pago'   => $request->metodo_pago,
            'precio_total'  => $precioTotal,
            'tipo_cliente'  => 'empresa',
        ]);

        return redirect()->route('alquileres.mis')
            ->with('success', 'Alquiler corporativo registrado correctamente.');
    }

    // ADMIN: editar
    public function edit(Alquiler $alquiler)
    {
        $usuarios = User::orderBy('name')->get();
        $bicicletas = Bicicleta::where('estado', 'disponible')->orWhere('id', $alquiler->bicicleta_id)->get();

        return view('alquileres.edit', compact('alquiler', 'usuarios', 'bicicletas'));
    }

    // ADMIN: actualizar
    public function update(Request $request, Alquiler $alquiler)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo_cliente' => 'required|in:individual,empresa',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
            'cantidad' => 'nullable|integer|min:1',
            'modo_entrega' => 'required|in:recoger,entregar',
            'direccion_entrega' => 'nullable|string|max:255',
            'metodo_pago' => 'required|in:efectivo,tarjeta,yape_plin',
            'observaciones' => 'nullable|string',
        ]);

        $bicicleta = Bicicleta::findOrFail($data['bicicleta_id']);
        $precio = $this->calcularPrecio($data['fecha_inicio'], $data['fecha_fin'], $bicicleta->precio_alquiler_hora, $data['cantidad'] ?? 1);

        $alquiler->update([
            'user_id'       => $data['user_id'],
            'bicicleta_id'  => $data['bicicleta_id'],
            'fecha_inicio'  => $data['fecha_inicio'],
            'fecha_fin'     => $data['fecha_fin'],
            'cantidad'      => $data['cantidad'] ?? 1,
            'modo_entrega'  => $data['modo_entrega'],
            'direccion_entrega' => $data['modo_entrega'] === 'entregar' ? ($data['direccion_entrega'] ?? null) : null,
            'metodo_pago'   => $data['metodo_pago'],
            'precio_total'  => $precio,
            'tipo_cliente'  => $data['tipo_cliente'],
            'observaciones' => $data['observaciones'] ?? null,
        ]);

        return redirect()->route('admin.alquileres.index')->with('success', 'Alquiler actualizado correctamente.');
    }

    // ADMIN: eliminar
    public function destroy(Alquiler $alquiler)
    {
        $alquiler->delete();

        return back()->with('success', 'Alquiler eliminado correctamente.');
    }

    private function calcularPrecio(string $inicio, string $fin, $precioHora, int $cantidad = 1): float
    {
        $precioHora = $precioHora ?? 0;
        $inicioDate = Carbon::parse($inicio);
        $finDate = Carbon::parse($fin);

        $horas = $finDate->diffInHours($inicioDate);
        if ($horas < 1) {
            $horas = 1;
        }

        if ($precioHora <= 0) {
            throw new \RuntimeException('La bicicleta seleccionada no tiene precio por hora configurado.');
        }

        return $horas * $precioHora * max(1, $cantidad);
    }
}
