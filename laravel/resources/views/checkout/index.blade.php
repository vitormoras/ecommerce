@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-shopping-bag me-2"></i>Finalizar Compra</h2>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Resumo do Pedido
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 50%">Produto</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-center">Preço</th>
                                    <th class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="fas fa-box fa-2x text-muted"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                <small class="text-muted">Código: #{{ $id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item['quantity'] }}</td>
                                    <td class="text-center">
                                        R$ {{ number_format($item['price'], 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <strong>Total:</strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="price-tag h5 mb-0">
                                            R$ {{ number_format($total, 2, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-truck me-2"></i>
                        Informações de Entrega
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Endereço</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="address" 
                                       name="address" 
                                       required>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Cidade</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="city" 
                                       name="city" 
                                       required>
                            </div>
                            <div class="col-md-2">
                                <label for="state" class="form-label">Estado</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="state" 
                                       name="state" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="zipcode" class="form-label">CEP</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="zipcode" 
                                       name="zipcode" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="tel" 
                                       class="form-control" 
                                       id="phone" 
                                       name="phone" 
                                       required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Voltar ao Carrinho
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-2"></i>
                                Confirmar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Resumo da Compra
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Frete</span>
                        <span class="text-success">Grátis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <span class="price-tag h5 mb-0">
                            R$ {{ number_format($total, 2, ',', '.') }}
                        </span>
                    </div>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Compra 100% segura
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 