@extends('layouts.app')

@section('title', 'Mi Dashboard')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Mi Dashboard</h1>
        <p>Bienvenido, {{ auth()->user()->name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📄</div>
            <div class="stat-info">
                <h3>{{ $totalQuotes }}</h3>
                <p>Mis Cotizaciones</p>
            </div>
        </div>
    </div>

    <div class="admin-menu">
        <a href="{{ route('user.quotes') }}" class="menu-item">
            <span class="icon">📋</span>
            <span>Ver Cotizaciones</span>
        </a>
        <a href="{{ route('user.settings') }}" class="menu-item">
            <span class="icon">⚙️</span>
            <span>Configuración</span>
        </a>
        <a href="{{ route('cotizador') }}" class="menu-item">
            <span class="icon">💰</span>
            <span>Ir al Cotizador</span>
        </a>
    </div>

    <div class="recent-quotes">
        <h2>Mis Cotizaciones Recientes</h2>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
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
                        <td>{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('user.quotes.show', $quote->id) }}" class="btn-view">Ver</a>
                            <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">PDF</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px;">No tienes cotizaciones</td>
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
        color: #01212E;
    }

    .admin-header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .admin-header p {
        color: #3A6D82;
        font-size: 1.1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, #01212E 0%, #3A6D82 100%);
        padding: 30px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: white;
        box-shadow: 0 5px 15px rgba(1, 33, 46, 0.2);
    }

    .stat-icon {
        font-size: 3rem;
    }

    .stat-info h3 {
        font-size: 2.5rem;
        margin: 0;
    }

    .stat-info p {
        margin: 5px 0 0;
        opacity: 0.9;
    }

    .admin-menu {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .menu-item {
        background: white;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        color: #01212E;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .menu-item:hover {
        border-color: #3A6D82;
        background: #3A6D82;
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(58, 109, 130, 0.3);
    }

    .menu-item .icon {
        font-size: 2.5rem;
    }

    .menu-item span:last-child {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .recent-quotes {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .recent-quotes h2 {
        color: #01212E;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead {
        background: #01212E;
        color: white;
    }

    .admin-table th,
    .admin-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .admin-table tbody tr:hover {
        background: #f5f5f5;
    }

    .btn-pdf {
        background: #3A6D82;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: background 0.3s;
    }

    .btn-pdf:hover {
        background: #01212E;
    }

    .btn-view {
        background: #01212E;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: background 0.3s;
        margin-right: 5px;
    }

    .btn-view:hover {
        background: #3A6D82;
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .admin-header h1 {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .admin-menu {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
