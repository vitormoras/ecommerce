@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Novo Produto</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="price" class="form-label">Preço</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="stock" class="form-label">Estoque</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="image" class="form-label">Imagem do Produto</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="form-text">Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB</div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Salvar Produto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection