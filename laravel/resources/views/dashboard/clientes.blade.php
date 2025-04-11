@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users me-2"></i>Relatório de Clientes</h2>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Imprimir Relatório
        </button>
    </div>

    <!-- Resumo Estatístico -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Clientes</h5>
                    <h2 class="mb-0">{{ $totalClientes }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Vendas</h5>
                    <h2 class="mb-0">{{ $totalVendas }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Faturamento Total</h5>
                    <h2 class="mb-0">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Média por Cliente</h5>
                    <div class="mb-1">{{ number_format($mediaVendasPorCliente, 1) }} vendas</div>
                    <div>R$ {{ number_format($mediaFaturamentoPorCliente, 2, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Clientes -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Contato</th>
                            <th>Total de Vendas</th>
                            <th>Valor Total</th>
                            <th>Última Compra</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td>
                                    <strong>{{ $cliente->nome }}</strong>
                                    <div class="text-muted small">{{ $cliente->endereco }}</div>
                                </td>
                                <td>
                                    <div>{{ $cliente->email }}</div>
                                    <div class="text-muted small">{{ $cliente->telefone }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $cliente->vendas->count() }} vendas
                                    </span>
                                </td>
                                <td>
                                    R$ {{ number_format($cliente->vendas->sum('total'), 2, ',', '.') }}
                                </td>
                                <td>
                                    @if($cliente->vendas->count() > 0)
                                        {{ $cliente->vendas->first()->data_venda->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Nenhuma compra</span>
                                    @endif
                                </td>
                                <td>
                                    @if($cliente->vendas->count() > 0)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-secondary">Inativo</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Nenhum cliente cadastrado.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .page-header button,
        .navbar {
            display: none !important;
        }
        .card {
            border: none !important;
        }
        .table th {
            background-color: #f8f9fa !important;
        }
    }
</style>
@endsection