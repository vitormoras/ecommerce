@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2><i class="fas fa-box me-2"></i>Lista de Produtos</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Novo Produto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card product-card h-100">
                    @if($product->stock <= 5)
                        <div class="stock-badge">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Estoque Baixo
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
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="price-tag">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </span>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                <i class="fas fa-box me-1"></i>
                                {{ $product->stock }} em estoque
                            </span>
                        </div>
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('products.show', $product) }}" 
                               class="btn btn-outline-primary" 
                               title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn btn-outline-warning" 
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger" 
                                        title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Nenhum produto cadastrado.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
