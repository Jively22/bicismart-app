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
        $bicicletas = Bicicleta::whereIn('id', array_keys($cart))->get();
        $total = 0;

        foreach ($bicicletas as $bici) {
            $cantidad = $cart[$bici->id];
            $precio = $bici->precio_venta ?? 0;
            $total += $cantidad * $precio;
        }

        return view('cart.index', compact('bicicletas', 'cart', 'total'));
    }

    public function add(Bicicleta $bicicleta)
    {
        if (!$bicicleta->precio_venta) {
            return back()->with('success', 'Esta bicicleta no está disponible para venta.');
        }

        $cart = session()->get('cart', []);
        $cart[$bicicleta->id] = ($cart[$bicicleta->id] ?? 0) + 1;
        session()->put('cart', $cart);

        return back()->with('success', 'Bicicleta agregada al carrito.');
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $cantidad = (int) $request->input('cantidad', 1);
        $cart = session()->get('cart', []);

        if ($cantidad <= 0) {
            unset($cart[$bicicleta->id]);
        } else {
            $cart[$bicicleta->id] = $cantidad;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Bicicleta $bicicleta)
    {
        $cart = session()->get('cart', []);
        unset($cart[$bicicleta->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Bicicleta eliminada del carrito.');
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (!$user || empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'No hay productos en el carrito.');
        }

        $bicicletas = Bicicleta::whereIn('id', array_keys($cart))->get();
        $total = 0;

        foreach ($bicicletas as $bici) {
            $cantidad = $cart[$bici->id];
            $precio = $bici->precio_venta ?? 0;
            $total += $cantidad * $precio;
        }

        if ($total <= 0) {
            return redirect()->route('cart.index')->with('success', 'No hay productos válidos para comprar.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);

        foreach ($bicicletas as $bici) {
            $cantidad = $cart[$bici->id];
            $precio = $bici->precio_venta ?? 0;

            OrderItem::create([
                'order_id' => $order->id,
                'bicicleta_id' => $bici->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $cantidad * $precio,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cart.historial')->with('success', 'Compra realizada correctamente.');
    }

    public function historial()
    {
        $user = Auth::user();
        $orders = Order::with('items.bicicleta')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('cart.historial', compact('orders'));
    }
}
