@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i>Gerenciamento de Clientes</h4>
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
                                    <th>Email</th>
                                    <th>Data de Cadastro</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Verificado
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Pendente
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-sm btn-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#userDetailsModal{{ $user->id }}">
                                                    <i class="fas fa-eye"></i> Detalhes
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal de Detalhes -->
                                    <div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detalhes do Cliente</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nome:</strong> {{ $user->name }}</p>
                                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                                    <p><strong>Data de Cadastro:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                                                    <p><strong>Status da Conta:</strong> 
                                                        @if($user->email_verified_at)
                                                            <span class="text-success">Verificado em {{ $user->email_verified_at->format('d/m/Y H:i') }}</span>
                                                        @else
                                                            <span class="text-warning">Pendente de Verificação</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle me-2"></i>Nenhum cliente cadastrado.
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
    </div>
</div>
@endsection 