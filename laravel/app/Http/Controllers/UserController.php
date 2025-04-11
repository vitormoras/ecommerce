<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        if ($user->is_admin && $user->id !== Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Você não tem permissão para editar o usuário administrador.');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->is_admin && $user->id !== Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Você não tem permissão para atualizar o usuário administrador.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('users.index')
                ->with('error', 'O usuário administrador não pode ser excluído.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}