<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlphaWear</title>

    <!-- Bootstrap CSS, Font Awesome e CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3490dc;
            --secondary-color: #38c172;
            --accent-color: #f6993f;
            --danger-color: #e3342f;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            background: linear-gradient(to right, #3490dc, #38c172);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-success {
            background-color: var(--secondary-color);
            border: none;
        }

        .btn-warning {
            background-color: var(--accent-color);
            border: none;
            color: white;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border: none;
        }

        .alert {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52,144,220,.25);
        }

        .badge {
            padding: 6px 10px;
            border-radius: 12px;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .product-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card .card-body {
            flex: 1;
        }

        .product-image {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-bolt me-2"></i>AlphaWear
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    @if(auth()->user()->is_admin)
                    <!-- Menu Admin -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="clientesDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-users me-1"></i> Clientes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.clientes') }}">
                                    <i class="fas fa-list me-2"></i>Listar Clientes
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('users.create') }}">
                                    <i class="fas fa-user-plus me-2"></i>Novo Cliente
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="estoqueDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-box me-1"></i> Estoque
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.index') }}">
                                    <i class="fas fa-list me-2"></i>Lista de Produtos
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.estoque') }}">
                                    <i class="fas fa-boxes me-2"></i>Ver Estoque
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('products.create') }}">
                                    <i class="fas fa-plus me-2"></i>Novo Produto
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}">
                                    <i class="fas fa-tags me-2"></i>Gerenciar Categorias
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="vendasDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-shopping-cart me-1"></i> Vendas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.vendas') }}">
                                    <i class="fas fa-history me-2"></i>Histórico de Vendas
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-plus me-2"></i>Nova Venda
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="relatoriosDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-file-alt me-1"></i> Relatórios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.relatorios') }}">
                                    <i class="fas fa-chart-bar me-2"></i>Ver Relatórios
                                </a></li>
                            </ul>
                        </li>
                    </ul>
                    @else
                    <!-- Menu Cliente -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.vitrine') }}">
                                <i class="fas fa-store me-1"></i> Vitrine
                            </a>
                        </li>
                    </ul>
                    @endif

                    <!-- Menu Direito -->
                    <ul class="navbar-nav ms-auto">
                        @if(!auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i> Carrinho
                                <span class="badge bg-danger">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }}</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i> Perfil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Registrar
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>