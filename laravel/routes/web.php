<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;

// Rota raiz redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de autenticação
Auth::routes(['verify' => true]);

// Rota home com redirecionamento baseado no tipo de usuário
Route::get('/home', function () {
    if (auth()->check()) {
        return auth()->user()->is_admin ? 
            redirect()->route('dashboard.index') : 
            redirect()->route('products.vitrine');
    }
    return redirect()->route('login');
})->name('home');

// Rotas públicas
Route::get('/vitrine', [ProductController::class, 'vitrine'])
    ->name('products.vitrine')
    ->middleware('auth');

// Rotas protegidas por autenticação (cliente)
Route::middleware(['auth', 'verified'])->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Carrinho
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Rotas protegidas por autenticação e admin
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/clientes', [DashboardController::class, 'clientes'])->name('dashboard.clientes');
    Route::get('/estoque', [DashboardController::class, 'estoque'])->name('dashboard.estoque');
    Route::get('/vendas', [DashboardController::class, 'vendas'])->name('dashboard.vendas');
    Route::get('/relatorios', [DashboardController::class, 'relatorios'])->name('dashboard.relatorios');
    
    // Gerenciamento de usuários
    Route::resource('users', UserController::class);
    
    // Gerenciamento de produtos
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    
    // Gerenciamento de categorias
    Route::resource('categories', CategoryController::class);
});

// Rotas de produtos visíveis para todos (requer autenticação)
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});

// Rotas de Categorias
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

// Rota pública para visualizar produtos por categoria
Route::get('categorias/{category}', [CategoryController::class, 'show'])->name('categories.show');

require __DIR__.'/auth.php';
