<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Bicicleta $bicicleta)
    {
        $cantidad = (int) $request->input('cantidad', 1);
        $cart = session()->get('cart', []);

        if (!isset($cart[$bicicleta->id])) {
            $cart[$bicicleta->id] = [
                'id' => $bicicleta->id,
                'nombre' => $bicicleta->nombre,
                'precio' => $bicicleta->precio_venta ?? 0,
                'cantidad' => 0,
            ];
        }

        $cart[$bicicleta->id]['cantidad'] += $cantidad;

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Bicicleta agregada al carrito.');
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $cantidad = (int) $request->input('cantidad', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$bicicleta->id])) {
            $cart[$bicicleta->id]['cantidad'] = max(1, $cantidad);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Carrito actualizado.');
    }

    public function remove(Bicicleta $bicicleta)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$bicicleta->id])) {
            unset($cart[$bicicleta->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'El carrito está vacío.');
        }

        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'estado' => 'confirmado',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'bicicleta_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $item['precio'] * $item['cantidad'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', 'Compra realizada con éxito. ¡Gracias por confiar en BiciSmart!');
    }
}
