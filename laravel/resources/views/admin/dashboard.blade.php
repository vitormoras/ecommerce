@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dashboard Administrativo</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Produtos</h5>
                                    <a href="{{ route('products.index') }}" class="btn btn-light">Gerenciar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Categorias</h5>
                                    <a href="{{ route('categories.index') }}" class="btn btn-light">Gerenciar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Usuários</h5>
                                    <a href="{{ route('users.index') }}" class="btn btn-light">Gerenciar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Relatórios</h5>
                                    <a href="{{ route('dashboard.relatorios') }}" class="btn btn-light">Visualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 