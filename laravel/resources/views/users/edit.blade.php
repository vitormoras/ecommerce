@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuário</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha (opcional)</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
