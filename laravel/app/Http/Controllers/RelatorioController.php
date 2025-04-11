<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venda;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function clientesPDF()
    {
        $clientes = Cliente::with(['vendas' => function($query) {
            $query->orderBy('data_venda', 'desc');
        }])->get();

        // Estatísticas gerais
        $totalClientes = $clientes->count();
        $totalVendas = Venda::count();
        $faturamentoTotal = Venda::sum('total');
        $mediaVendasPorCliente = $totalClientes > 0 ? $totalVendas / $totalClientes : 0;
        $mediaFaturamentoPorCliente = $totalClientes > 0 ? $faturamentoTotal / $totalClientes : 0;

        $pdf = PDF::loadView('relatorios.clientes-pdf', compact(
            'clientes',
            'totalClientes',
            'totalVendas',
            'faturamentoTotal',
            'mediaVendasPorCliente',
            'mediaFaturamentoPorCliente'
        ));

        return $pdf->download('relatorio-clientes.pdf');
    }

    public function vendasPDF()
    {
        $vendasMensais = Venda::selectRaw('
            YEAR(data_venda) as ano,
            MONTH(data_venda) as mes,
            COUNT(*) as total_vendas,
            SUM(total) as total
        ')
        ->groupBy('ano', 'mes')
        ->orderBy('ano', 'desc')
        ->orderBy('mes', 'desc')
        ->get();

        $pdf = PDF::loadView('relatorios.vendas-pdf', compact('vendasMensais'));
        return $pdf->download('relatorio-vendas.pdf');
    }
} 