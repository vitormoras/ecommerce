<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        $cart = [];
        $total = 0;
        
        foreach ($cartItems as $item) {
            $subtotal = $item->product->price * $item->quantity;
            $total += $subtotal;
            
            $cart[$item->product_id] = [
                'name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'image' => $item->product->image,
                'subtotal' => $subtotal
            ];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Seu carrinho está vazio.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            // Criar o pedido
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending'
            ]);

            // Criar os itens do pedido
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // Limpar o carrinho
            Cart::where('user_id', Auth::id())->delete();
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Pedido realizado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                ->with('error', 'Erro ao processar o pedido. Por favor, tente novamente.');
        }
    }
}
