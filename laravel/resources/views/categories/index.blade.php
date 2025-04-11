@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-tags me-2"></i>Categorias</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Nova Categoria
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Produtos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" 
                                             alt="{{ $category->name }}"
                                             class="category-thumbnail">
                                    @else
                                        <div class="category-placeholder">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 100) }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.show', $category) }}" 
                                           class="btn btn-sm btn-info"
                                           title="Ver produtos">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category) }}" 
                                           class="btn btn-sm btn-primary"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Nenhuma categoria cadastrada.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .category-thumbnail {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    .category-placeholder {
        width: 50px;
        height: 50px;
        background-color: #f8f9fa;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }

    .btn-group {
        display: flex;
        gap: 0.25rem;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection 