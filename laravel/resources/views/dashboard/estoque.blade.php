@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Estoque</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade em Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>{{ $produto->quantidade_estoque }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection