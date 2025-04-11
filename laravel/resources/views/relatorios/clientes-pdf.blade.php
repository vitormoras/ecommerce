<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Clientes</title>
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
        .stats {
            margin-bottom: 20px;
        }
        .stats table {
            width: 100%;
            border-collapse: collapse;
        }
        .stats td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .stats .label {
            font-weight: bold;
            background-color: #f5f5f5;
        }
        .clients {
            margin-top: 20px;
        }
        .clients table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .clients th {
            background-color: #f5f5f5;
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .clients td {
            padding: 5px;
            border: 1px solid #ddd;
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
        <h1>Relatório de Clientes</h1>
        <p>Data: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="stats">
        <table>
            <tr>
                <td class="label">Total de Clientes:</td>
                <td>{{ $totalClientes }}</td>
                <td class="label">Total de Vendas:</td>
                <td>{{ $totalVendas }}</td>
            </tr>
            <tr>
                <td class="label">Faturamento Total:</td>
                <td>R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</td>
                <td class="label">Média por Cliente:</td>
                <td>{{ number_format($mediaVendasPorCliente, 1) }} vendas / R$ {{ number_format($mediaFaturamentoPorCliente, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="clients">
        <table>
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
                @foreach($clientes as $cliente)
                    <tr>
                        <td>
                            <strong>{{ $cliente->nome }}</strong><br>
                            {{ $cliente->endereco }}
                        </td>
                        <td>
                            {{ $cliente->email }}<br>
                            {{ $cliente->telefone }}
                        </td>
                        <td>{{ $cliente->vendas->count() }}</td>
                        <td>R$ {{ number_format($cliente->vendas->sum('total'), 2, ',', '.') }}</td>
                        <td>
                            @if($cliente->vendas->count() > 0)
                                {{ $cliente->vendas->first()->data_venda->format('d/m/Y') }}
                            @else
                                Nenhuma compra
                            @endif
                        </td>
                        <td>
                            @if($cliente->vendas->count() > 0)
                                Ativo
                            @else
                                Inativo
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