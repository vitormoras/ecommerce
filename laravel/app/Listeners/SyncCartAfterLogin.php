<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class SyncCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $cartItems = Cart::where('user_id', $event->user->id)
            ->with('product')
            ->get();

        $cart = [];
        
        foreach ($cartItems as $item) {
            $subtotal = $item->product->price * $item->quantity;
            
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
}
