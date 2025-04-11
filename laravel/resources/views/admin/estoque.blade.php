@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gerenciamento de Estoque</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Novo Produto</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? 'Sem categoria' }}</td>
                                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.edit', $product->id) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 