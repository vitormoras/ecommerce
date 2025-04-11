@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-store me-2"></i>Vitrine de Produtos</h2>
    </div>

    <!-- Seção de Categorias -->
    <div class="categories-section mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-tags me-2"></i>Categorias
                </h5>
                <div class="row g-2">
                    @foreach($categories as $category)
                        <div class="col-auto">
                            <a href="{{ route('categories.show', $category) }}" 
                               class="btn btn-outline-primary btn-sm">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                         alt="{{ $category->name }}"
                                         class="category-icon me-1">
                                @else
                                    <i class="fas fa-folder me-1"></i>
                                @endif
                                {{ $category->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('products.vitrine') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               placeholder="Buscar produtos..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="order">
                        <option value="">Ordenar por...</option>
                        <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>
                            Menor Preço
                        </option>
                        <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>
                            Maior Preço
                        </option>
                        <option value="name_asc" {{ request('order') == 'name_asc' ? 'selected' : '' }}>
                            Nome (A-Z)
                        </option>
                        <option value="name_desc" {{ request('order') == 'name_desc' ? 'selected' : '' }}>
                            Nome (Z-A)
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="availability">
                        <option value="">Disponibilidade</option>
                        <option value="in_stock" {{ request('availability') == 'in_stock' ? 'selected' : '' }}>
                            Em Estoque
                        </option>
                        <option value="out_of_stock" {{ request('availability') == 'out_of_stock' ? 'selected' : '' }}>
                            Fora de Estoque
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-2"></i>Filtrar
                        </button>
                    </div>
                </div>
                @if(request()->anyFilled(['search', 'order', 'availability']))
                    <div class="col-12">
                        <a href="{{ route('products.vitrine') }}" class="btn btn-link text-decoration-none">
                            <i class="fas fa-times me-2"></i>Limpar Filtros
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Lista de Produtos -->
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
                        @if($product->category)
                            <div class="mb-2">
                                <a href="{{ route('categories.show', $product->category) }}" 
                                   class="badge bg-info text-decoration-none">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $product->category->name }}
                                </a>
                            </div>
                        @endif
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
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
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
                    Nenhum produto disponível no momento.
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
        width: 20px;
        height: 20px;
        object-fit: cover;
        border-radius: 3px;
    }
</style>
@endsection