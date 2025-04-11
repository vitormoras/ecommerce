<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Vendas</title>
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
        .sales {
            margin-top: 20px;
        }
        .sales table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .sales th {
            background-color: #f5f5f5;
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .sales td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .total {
            margin-top: 20px;
            text-align: right;
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
        <h1>Relatório de Vendas</h1>
        <p>Data: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="sales">
        <table>
            <thead>
                <tr>
                    <th>Mês/Ano</th>
                    <th>Total de Vendas</th>
                    <th>Faturamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendas as $venda)
                    <tr>
                        <td>{{ $venda->mes_ano }}</td>
                        <td>{{ $venda->total_vendas }}</td>
                        <td>R$ {{ number_format($venda->faturamento, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        Faturamento Total: R$ {{ number_format($vendas->sum('faturamento'), 2, ',', '.') }}
    </div>

    <div class="footer">
        Gerado em: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html> 