@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-chart-line me-2"></i>Relatórios</h4>
                    <div>
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Imprimir Relatório
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Cards de Resumo -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total de Vendas</h6>
                                    <h3 class="mb-0">{{ $totalVendas }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Faturamento Total</h6>
                                    <h3 class="mb-0">R$ {{ number_format($totalFaturamento, 2, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Ticket Médio</h6>
                                    <h3 class="mb-0">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Vendas Pendentes</h6>
                                    <h3 class="mb-0">
                                        {{ $vendasPorStatus->where('status', 'pending')->first()?->total ?? 0 }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico de Vendas Mensais -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Vendas por Mês</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Período</th>
                                            <th>Quantidade</th>
                                            <th>Valor Total</th>
                                            <th>Média por Venda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vendasMensais as $venda)
                                            <tr>
                                                <td>{{ $venda->mes }}/{{ $venda->ano }}</td>
                                                <td>{{ $venda->total_vendas }}</td>
                                                <td>R$ {{ number_format($venda->total_valor, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($venda->total_valor / $venda->total_vendas, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Status das Vendas -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Status das Vendas</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Quantidade</th>
                                            <th>Valor Total</th>
                                            <th>% do Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vendasPorStatus as $status)
                                            <tr>
                                                <td>
                                                    @switch($status->status)
                                                        @case('pending')
                                                            <span class="badge bg-warning">Pendente</span>
                                                            @break
                                                        @case('paid')
                                                            <span class="badge bg-success">Pago</span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge bg-danger">Cancelado</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary">{{ $status->status }}</span>
                                                    @endswitch
                                                </td>
                                                <td>{{ $status->total }}</td>
                                                <td>R$ {{ number_format($status->valor_total, 2, ',', '.') }}</td>
                                                <td>{{ number_format(($status->total / $totalVendas) * 100, 1) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aqui você pode adicionar gráficos usando Chart.js se desejar
});
</script>
@endpush
@endsection 