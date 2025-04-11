@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total de Clientes</h5>
                    <h3>{{ $totalClientes }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total de Produtos</h5>
                    <h3>{{ $totalProdutos }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total de Vendas</h5>
                    <h3>{{ $totalVendas }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Faturamento Total</h5>
                    <h3>R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <a href="{{ route('dashboard.clientes') }}" class="btn btn-primary">Ver Clientes</a>
    <a href="{{ route('dashboard.estoque') }}" class="btn btn-primary">Ver Estoque</a>
    <a href="{{ route('dashboard.vendas') }}" class="btn btn-primary">Ver Vendas</a>
    <a href="{{ route('dashboard.relatorios') }}" class="btn btn-primary">Ver Relatórios</a>
</div>
@endsection
