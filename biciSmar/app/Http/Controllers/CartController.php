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
        $cart = session('cart', []);

        if (empty($cart)) {
            return view('cart.index', ['cart' => [], 'bicicletas' => [], 'total' => 0]);
        }

        $ids = array_keys($cart);
        $bicicletas = Bicicleta::whereIn('id', $ids)->get();
        $total = 0;

        foreach ($bicicletas as $bici) {
            $total += ($bici->precio_venta ?? 0) * $cart[$bici->id];
        }

        return view('cart.index', compact('cart', 'bicicletas', 'total'));
    }

    public function add(Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        $cart[$bicicleta->id] = ($cart[$bicicleta->id] ?? 0) + 1;
        session(['cart' => $cart]);

        return back()->with('success', 'Bicicleta añadida al carrito.');
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        $cantidad = max(1, (int) $request->input('cantidad', 1));
        $cart[$bicicleta->id] = $cantidad;
        session(['cart' => $cart]);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        unset($cart[$bicicleta->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Bicicleta eliminada del carrito.');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('success', 'Tu carrito está vacío.');
        }

        $user = Auth::user();
        $ids = array_keys($cart);
        $bicicletas = Bicicleta::whereIn('id', $ids)->get();

        $total = 0;
        foreach ($bicicletas as $bici) {
            $total += ($bici->precio_venta ?? 0) * $cart[$bici->id];
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);

        foreach ($bicicletas as $bici) {
            OrderItem::create([
                'order_id' => $order->id,
                'bicicleta_id' => $bici->id,
                'cantidad' => $cart[$bici->id],
                'precio_unitario' => $bici->precio_venta ?? 0,
                'subtotal' => ($bici->precio_venta ?? 0) * $cart[$bici->id],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cart.historial')->with('success', 'Compra registrada correctamente.');
    }

    public function historial()
    {
        $orders = Order::with('items.bicicleta')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('cart.historial', compact('orders'));
    }
}
