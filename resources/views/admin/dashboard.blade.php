@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Panel de Superadministrador</h1>
        <p>Bienvenido, {{ auth()->user()->name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Usuarios</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📄</div>
            <div class="stat-info">
                <h3>{{ $totalQuotes }}</h3>
                <p>Total Cotizaciones</p>
            </div>
        </div>
    </div>

    <div class="admin-menu">
        <a href="{{ route('admin.users') }}" class="menu-item">
            <span class="icon">👤</span>
            <span>Gestionar Usuarios</span>
        </a>
        <a href="{{ route('admin.quotes') }}" class="menu-item">
            <span class="icon">📋</span>
            <span>Ver Cotizaciones</span>
        </a>
        <a href="{{ route('admin.products') }}" class="menu-item">
            <span class="icon">📦</span>
            <span>Gestionar Productos</span>
        </a>
        <a href="{{ route('admin.settings') }}" class="menu-item">
            <span class="icon">⚙️</span>
            <span>Configuración</span>
        </a>
        <a href="{{ route('cotizador') }}" class="menu-item">
            <span class="icon">💰</span>
            <span>Ir al Cotizador</span>
        </a>
    </div>

    <div class="recent-quotes">
        <h2>Cotizaciones Recientes</h2>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentQuotes as $quote)
                    <tr>
                        <td>#{{ $quote->id }}</td>
                        <td>{{ $quote->client_name }}</td>
                        <td>S/. {{ number_format($quote->total_pen, 2) }}</td>
                        <td>{{ $quote->user->name }}</td>
                        <td>{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.quotes.show', $quote->id) }}" class="btn-view">Ver</a>
                            <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">PDF</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">No hay cotizaciones</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px;
    }

    .admin-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .admin-header h1 {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-icon {
        font-size: 3rem;
    }

    .stat-info h3 {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-info p {
        color: var(--text-light);
        font-size: 1rem;
    }

    .admin-menu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .menu-item {
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        color: white;
        padding: 30px;
        border-radius: 12px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .menu-item .icon {
        font-size: 2rem;
    }

    .recent-quotes {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .recent-quotes h2 {
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        background: var(--primary-color);
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    .admin-table td {
        padding: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .admin-table tr:hover {
        background: var(--light-bg);
    }

    .btn-view, .btn-pdf {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin-right: 5px;
    }

    .btn-view {
        background: var(--secondary-color);
        color: white;
    }

    .btn-pdf {
        background: var(--error);
        color: white;
    }
</style>
@endsection
