@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2><i class="fas fa-shopping-cart me-2"></i>Seu Carrinho</h2>
        @if($cart)
            <a href="{{ route('cart.clear') }}" 
               class="btn btn-outline-danger"
               onclick="return confirm('Tem certeza que deseja esvaziar o carrinho?')">
                <i class="fas fa-trash-alt me-2"></i>
                Esvaziar Carrinho
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($cart)
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%">Produto</th>
                                <th class="text-center">Preço</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($cart as $id => $item)
                                @php 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3" style="width: 60px; height: 60px;">
                                                @if(isset($item['image']) && $item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}" 
                                                         alt="{{ $item['name'] }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light rounded">
                                                        <i class="fas fa-box fa-2x text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                <small class="text-muted">Código: #{{ $id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="price-tag">
                                            R$ {{ number_format($item['price'], 2, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <form action="{{ route('cart.update', $id) }}" 
                                                  method="POST" 
                                                  class="d-flex align-items-center">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        name="action" 
                                                        value="decrease" 
                                                        class="btn btn-sm btn-outline-secondary me-2"
                                                        {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span class="mx-2">{{ $item['quantity'] }}</span>
                                                <button type="submit" 
                                                        name="action" 
                                                        value="increase" 
                                                        class="btn btn-sm btn-outline-secondary ms-2">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="price-tag">
                                            R$ {{ number_format($item['subtotal'], 2, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('cart.remove', $id) }}" 
                                           class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Tem certeza que deseja remover este item?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.vitrine') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Continuar Comprando
                    </a>
                    <a href="{{ route('checkout') }}" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>
                        Finalizar Compra
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Seu carrinho está vazio</h4>
            <p class="text-muted mb-4">Adicione produtos para começar suas compras</p>
            <a href="{{ route('products.vitrine') }}" class="btn btn-primary">
                <i class="fas fa-store me-2"></i>
                Ir para a Vitrine
            </a>
        </div>
    @endif
</div>
@endsection
