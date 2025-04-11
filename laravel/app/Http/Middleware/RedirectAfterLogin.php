<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Se o usuário for admin, redireciona para o dashboard
            if (Auth::user()->is_admin) {
                return redirect()->route('dashboard.index');
            }
            // Se for cliente, redireciona para a vitrine
            return redirect()->route('products.vitrine');
        }

        return $next($request);
    }
} 