@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Detalhes do Produto</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded">
                    @else
                        <div class="text-center p-5 bg-light rounded">
                            <i class="fas fa-image fa-4x text-muted"></i>
                            <p class="mt-2">Sem imagem</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3>{{ $product->name }}</h3>
                    <hr>
                    <div class="mb-3">
                        <h5>Descrição</h5>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Preço</h5>
                            <p class="h4 text-primary">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Estoque</h5>
                            <p>
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                    {{ $product->stock }} unidades
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 