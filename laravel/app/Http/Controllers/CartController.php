<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function syncCartWithSession()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

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

        Session::put('cart', $cart);
        return $cart;
    }

    public function index()
    {
        $cart = $this->syncCartWithSession();
        $total = array_sum(array_map(fn($item) => $item['subtotal'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        $this->syncCartWithSession();
        return redirect()->route('cart.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        $this->syncCartWithSession();
        return redirect()->route('cart.index')->with('success', 'Produto removido!');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrinho esvaziado!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            if ($request->action === 'increase') {
                $cartItem->increment('quantity');
            } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
            
            $this->syncCartWithSession();
            return redirect()->route('cart.index')->with('success', 'Quantidade atualizada!');
        }
        
        return redirect()->route('cart.index')->with('error', 'Produto não encontrado no carrinho!');
    }
}

