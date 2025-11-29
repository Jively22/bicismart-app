<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn ($item) => $item['subtotal']);

        return view('carrito.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'cantidad' => 'required|integer|min:1',
            'modo' => 'required|in:venta,alquiler',
        ]);

        $bicicleta = Bicicleta::findOrFail($validated['bicicleta_id']);

        $precioBase = $validated['modo'] === 'venta'
            ? ($bicicleta->precio_venta ?? $bicicleta->precio_alquiler_hora ?? 0)
            : ($bicicleta->precio_alquiler_hora ?? $bicicleta->precio_alquiler_dia ?? 0);

        $precio = max($precioBase, 0);

        $cart = session('cart', []);
        $existing = $cart[$bicicleta->id] ?? null;
        $cantidad = $validated['cantidad'] + ($existing['cantidad'] ?? 0);

        $cart[$bicicleta->id] = [
            'bicicleta_id' => $bicicleta->id,
            'nombre' => $bicicleta->marca . ' ' . $bicicleta->modelo,
            'modo' => $validated['modo'],
            'precio_unitario' => $precio,
            'cantidad' => $cantidad,
            'subtotal' => $cantidad * $precio,
        ];

        session(['cart' => $cart]);

        return back()->with('success', 'Bicicleta agregada al carrito');
    }

    public function update(Request $request, int $bicicletaId)
    {
        $validated = $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (!isset($cart[$bicicletaId])) {
            return back()->with('error', 'La bicicleta no existe en el carrito');
        }

        $cart[$bicicletaId]['cantidad'] = $validated['cantidad'];
        $cart[$bicicletaId]['subtotal'] = $validated['cantidad'] * $cart[$bicicletaId]['precio_unitario'];

        session(['cart' => $cart]);

        return back()->with('success', 'Carrito actualizado');
    }

    public function remove(int $bicicletaId)
    {
        $cart = session('cart', []);
        unset($cart[$bicicletaId]);
        session(['cart' => $cart]);

        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Carrito vacío');
    }
}