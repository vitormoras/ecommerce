<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
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
        }

        return $next($request);
    }
}
