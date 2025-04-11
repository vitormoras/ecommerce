<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Faça login para finalizar a compra.');
        }

        $cart = Session::get('cart', []);
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'O carrinho está vazio.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'status' => 'pendente'
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        Session::forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Compra finalizada com sucesso!');
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }
}