@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-edit me-2"></i>Editar Categoria</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
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
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome da Categoria</label>
                        <input type="text" 
                               class="form-control" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               required>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Imagem da Categoria</label>
                        <input type="file" 
                               class="form-control" 
                               id="image" 
                               name="image" 
                               accept="image/*">
                        <div class="form-text">
                            Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB
                        </div>
                        
                        @if($category->image)
                            <div class="mt-2">
                                <label class="form-label">Imagem Atual</label>
                                <div>
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         class="img-thumbnail" 
                                         style="max-height: 100px;">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 