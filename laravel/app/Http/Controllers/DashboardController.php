<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function clientes()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.clientes', compact('users'));
    }

    public function estoque()
    {
        $products = Product::with('category')->get();
        return view('admin.estoque', compact('products'));
    }

    public function vendas()
    {
        $vendas = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);

        $totalVendas = Order::sum('total');
        $vendasConcluidas = Order::where('status', 'paid')->count();
        $vendasPendentes = Order::where('status', 'pending')->count();
        $ticketMedio = Order::where('status', 'paid')->avg('total') ?? 0;

        return view('admin.vendas', compact(
            'vendas',
            'totalVendas',
            'vendasConcluidas',
            'vendasPendentes',
            'ticketMedio'
        ));
    }

    public function relatorios()
    {
        $vendasMensais = Order::selectRaw('
            YEAR(created_at) as ano,
            MONTH(created_at) as mes,
            COUNT(*) as total_vendas,
            SUM(total) as total_valor
        ')
        ->groupBy('ano', 'mes')
        ->orderBy('ano', 'desc')
        ->orderBy('mes', 'desc')
        ->get();

        $totalVendas = Order::count();
        $totalFaturamento = Order::sum('total');
        $ticketMedio = $totalVendas > 0 ? ($totalFaturamento / $totalVendas) : 0;
        $vendasPorStatus = Order::selectRaw('
            status,
            COUNT(*) as total,
            SUM(total) as valor_total
        ')
        ->groupBy('status')
        ->get();

        return view('admin.relatorios', compact(
            'vendasMensais',
            'totalVendas',
            'totalFaturamento',
            'ticketMedio',
            'vendasPorStatus'
        ));
    }
}