@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Histórico de Vendas</h4>
                    <div>
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Imprimir Relatório
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Período</label>
                            <select class="form-select" id="period">
                                <option value="today">Hoje</option>
                                <option value="week">Última Semana</option>
                                <option value="month" selected>Último Mês</option>
                                <option value="year">Último Ano</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="">Todos</option>
                                <option value="pending">Pendente</option>
                                <option value="paid">Pago</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cliente</label>
                            <input type="text" class="form-control" placeholder="Buscar por cliente...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i>Filtrar
                            </button>
                        </div>
                    </div>

                    <!-- Resumo -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total de Vendas</h6>
                                    <h3 class="mb-0">R$ {{ number_format($totalVendas ?? 0, 2, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Vendas Concluídas</h6>
                                    <h3 class="mb-0">{{ $vendasConcluidas ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Vendas Pendentes</h6>
                                    <h3 class="mb-0">{{ $vendasPendentes ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Ticket Médio</h6>
                                    <h3 class="mb-0">R$ {{ number_format($ticketMedio ?? 0, 2, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabela de Vendas -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th>Produtos</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vendas ?? [] as $venda)
                                    <tr>
                                        <td>#{{ $venda->id }}</td>
                                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $venda->user->name }}</td>
                                        <td>{{ $venda->items_count }} itens</td>
                                        <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                                        <td>
                                            @switch($venda->status)
                                                @case('paid')
                                                    <span class="badge bg-success">Pago</span>
                                                    @break
                                                @case('pending')
                                                    <span class="badge bg-warning">Pendente</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge bg-danger">Cancelado</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ $venda->status }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#vendaModal{{ $venda->id }}">
                                                <i class="fas fa-eye"></i> Detalhes
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal de Detalhes -->
                                    <div class="modal fade" id="vendaModal{{ $venda->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detalhes da Venda #{{ $venda->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <h6>Informações do Cliente</h6>
                                                            <p><strong>Nome:</strong> {{ $venda->user->name }}</p>
                                                            <p><strong>Email:</strong> {{ $venda->user->email }}</p>
                                                            <p><strong>Data da Compra:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Informações do Pagamento</h6>
                                                            <p><strong>Status:</strong> 
                                                                @switch($venda->status)
                                                                    @case('paid')
                                                                        <span class="badge bg-success">Pago</span>
                                                                        @break
                                                                    @case('pending')
                                                                        <span class="badge bg-warning">Pendente</span>
                                                                        @break
                                                                    @case('cancelled')
                                                                        <span class="badge bg-danger">Cancelado</span>
                                                                        @break
                                                                    @default
                                                                        <span class="badge bg-secondary">{{ $venda->status }}</span>
                                                                @endswitch
                                                            </p>
                                                            <p><strong>Método:</strong> {{ $venda->payment_method ?? 'N/A' }}</p>
                                                            <p><strong>Total:</strong> R$ {{ number_format($venda->total, 2, ',', '.') }}</p>
                                                        </div>
                                                    </div>

                                                    <h6>Produtos</h6>
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Produto</th>
                                                                <th>Quantidade</th>
                                                                <th>Preço Unit.</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($venda->items as $item)
                                                                <tr>
                                                                    <td>{{ $item->product->name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                                                                    <td>R$ {{ number_format($item->quantity * $item->price, 2, ',', '.') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                                <td><strong>R$ {{ number_format($venda->total, 2, ',', '.') }}</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" class="btn btn-primary" onclick="window.print()">
                                                        <i class="fas fa-print me-1"></i>Imprimir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle me-2"></i>Nenhuma venda encontrada.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    @if(isset($vendas) && $vendas->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $vendas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 