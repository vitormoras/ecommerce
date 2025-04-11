# AlphaWear - E-commerce de Roupas

Sistema de e-commerce desenvolvido com Laravel, oferecendo uma plataforma completa para venda de roupas e acessórios.

## Funcionalidades

-   🛍️ Vitrine de produtos com categorias
-   🛒 Carrinho de compras
-   👤 Área do cliente
-   📊 Painel administrativo
-   📦 Gestão de produtos
-   📋 Relatórios de vendas
-   👥 Gestão de usuários

## Requisitos

-   PHP >= 8.2
-   Composer
-   MySQL
-   Node.js & NPM

## Instalação

1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/alphawear.git
cd alphawear
```

2. Instale as dependências do PHP

```bash
composer install
```

3. Copie o arquivo de ambiente

```bash
cp .env.example .env
```

4. Configure o arquivo .env com suas credenciais de banco de dados

5. Gere a chave da aplicação

```bash
php artisan key:generate
```

6. Execute as migrations

```bash
php artisan migrate
```

7. (Opcional) Execute os seeders para dados de exemplo

```bash
php artisan db:seed
```

8. Crie o link simbólico para o storage

```bash
php artisan storage:link
```

## Uso

Para iniciar o servidor de desenvolvimento:

```bash
php artisan serve
```

## Tecnologias Utilizadas

-   Laravel 10
-   MySQL
-   Bootstrap 5
-   JavaScript
-   Font Awesome

## Recursos

-   Sistema de autenticação completo
-   Gerenciamento de produtos e categorias
-   Carrinho de compras persistente
-   Painel administrativo com relatórios
-   Interface responsiva
-   Gestão de pedidos

## Contribuição

Contribuições são bem-vindas! Por favor, sinta-se à vontade para enviar um Pull Request.
