@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" 
                         alt="{{ $category->name }}"
                         class="category-icon me-2">
                @else
                    <i class="fas fa-folder me-2"></i>
                @endif
                {{ $category->name }}
            </h2>
            @if($category->description)
                <p class="text-muted">{{ $category->description }}</p>
            @endif
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('products.vitrine') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar para Vitrine
            </a>
        </div>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    @if($product->stock <= 5 && $product->stock > 0)
                        <div class="stock-badge">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Últimas Unidades
                            </span>
                        </div>
                    @elseif($product->stock == 0)
                        <div class="stock-badge">
                            <span class="badge bg-danger">
                                <i class="fas fa-times-circle me-1"></i>
                                Fora de Estoque
                            </span>
                        </div>
                    @endif

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="product-image" 
                             alt="{{ $product->name }}">
                    @else
                        <div class="text-center p-4 bg-light">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="price-tag">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </span>
                                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    <i class="fas fa-box me-1"></i>
                                    {{ $product->stock }} em estoque
                                </span>
                            </div>
                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-cart-plus me-2"></i>
                                            Adicionar ao Carrinho
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-times-circle me-2"></i>
                                        Indisponível
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="btn btn-outline-primary w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Faça login para comprar
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Nenhum produto encontrado nesta categoria.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>

<style>
    .category-icon {
        width: 32px;
        height: 32px;
        object-fit: cover;
        border-radius: 4px;
    }
</style>
@endsection 