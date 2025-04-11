@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vendas</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Funcionário</th>
                <th>Data</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->cliente->nome }}</td>
                    <td>{{ $venda->funcionario->nome }}</td>
                    <td>{{ $venda->data_venda}}</td>
                    <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection