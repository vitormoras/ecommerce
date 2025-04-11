<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login primeiro.');
        }

        if (!Auth::user()->is_admin) {
            return redirect()->route('products.vitrine')->with('error', 'Acesso não autorizado. Esta área é restrita para administradores.');
        }

        return $next($request);
    }
} 