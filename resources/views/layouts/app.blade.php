<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cotizador Hyperzas')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #01212E;
            --secondary-color: #3A6D82;
            --accent-color: #5A95B0;
            --light-bg: #f5f8fa;
            --white: #ffffff;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --success: #27ae60;
            --error: #e74c3c;
            --border-color: #dfe6e9;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navbar */
        .navbar {
            background: var(--primary-color);
            color: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            color: var(--white);
            font-weight: 500;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: var(--secondary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(58, 109, 130, 0.3);
        }

        .btn-logout {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-logout:hover {
            background: var(--white);
            color: var(--primary-color);
        }

        .btn-admin {
            background: #f39c12;
            color: var(--white);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .user-name small {
            opacity: 0.8;
            font-size: 0.8rem;
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary-color);
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid var(--success);
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid var(--error);
        }
    </style>
    @yield('styles')
</head>
<body>
    @auth
    <nav class="navbar">
        <a href="{{ route('cotizador') }}" class="navbar-brand">
            Sistema de Cotizaciones Hyperzas
        </a>
        <div class="navbar-user">
            <span class="user-name">{{ Auth::user()->name }} <small>({{ ucfirst(Auth::user()->role) }})</small></span>
            @if(Auth::user()->role === 'superadmin')
                <a href="{{ route('admin.dashboard') }}" class="btn-admin">Panel Admin</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </nav>
    @endauth

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
