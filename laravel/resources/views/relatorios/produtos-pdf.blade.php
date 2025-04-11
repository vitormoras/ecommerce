<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            margin: 5px 0;
        }
        .products {
            margin-top: 20px;
        }
        .products table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .products th {
            background-color: #f5f5f5;
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .products td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .summary {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .summary-item {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 23%;
        }
        .summary-item h3 {
            margin: 0;
            font-size: 14px;
        }
        .summary-item p {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Produtos</h1>
        <p>Data: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>Total de Produtos</h3>
            <p>{{ $total_produtos }}</p>
        </div>
        <div class="summary-item">
            <h3>Produtos em Estoque</h3>
            <p>{{ $produtos_estoque }}</p>
        </div>
        <div class="summary-item">
            <h3>Produtos com Estoque Baixo</h3>
            <p>{{ $produtos_estoque_baixo }}</p>
        </div>
        <div class="summary-item">
            <h3>Produtos Sem Estoque</h3>
            <p>{{ $produtos_sem_estoque }}</p>
        </div>
    </div>

    <div class="products">
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->categoria->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->estoque }}</td>
                        <td>
                            @if($produto->estoque > 10)
                                <span style="color: green">Em Estoque</span>
                            @elseif($produto->estoque > 0)
                                <span style="color: orange">Estoque Baixo</span>
                            @else
                                <span style="color: red">Sem Estoque</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Gerado em: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html> 