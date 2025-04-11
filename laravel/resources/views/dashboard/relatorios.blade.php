@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-file-alt me-2"></i>Relatórios</h2>
        <div class="btn-group">
            <a href="{{ route('relatorios.clientes.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i>Exportar Clientes (PDF)
            </a>
            <a href="{{ route('relatorios.vendas.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i>Exportar Vendas (PDF)
            </a>
        </div>
    </div>

    <!-- Relatório de Vendas Mensais -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-chart-line me-2"></i>Vendas Mensais
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mês/Ano</th>
                            <th>Total de Vendas</th>
                            <th>Faturamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendasMensais as $venda)
                            <tr>
                                <td>{{ $venda->mes }}/{{ $venda->ano }}</td>
                                <td>{{ $venda->total_vendas }}</td>
                                <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Nenhum dado de venda disponível.
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
@endsection