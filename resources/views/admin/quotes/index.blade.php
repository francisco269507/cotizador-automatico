@extends('layouts.app')

@section('title', 'Cotizaciones')

@section('content')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px;
    }
</style>

<div class="admin-container">
    <div class="page-header-admin">
        <h1>Todas las Cotizaciones</h1>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Empresa</th>
                    <th>Total (PEN)</th>
                    <th>Generado por</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotes as $quote)
                <tr>
                    <td>#{{ $quote->id }}</td>
                    <td>
                        <strong>{{ $quote->client_name }}</strong><br>
                        <small style="color: #666;">{{ $quote->client_email }}</small>
                    </td>
                    <td>{{ $quote->client_company ?: '-' }}</td>
                    <td><strong>S/. {{ number_format($quote->total_pen, 2) }}</strong></td>
                    <td>
                        <span class="user-badge">
                            {{ $quote->user->name }}
                            <small>({{ $quote->user->role }})</small>
                        </span>
                    </td>
                    <td>{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.quotes.show', $quote->id) }}" class="btn-view">Ver Detalle</a>
                        <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">PDF</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px;">No hay cotizaciones registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $quotes->links() }}
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Volver al Dashboard</a>
    </div>
</div>

<style>
    .page-header-admin {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header-admin h1 {
        font-size: 2rem;
        color: var(--primary-color);
    }

    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead {
        background: var(--primary-color);
        color: white;
    }

    .admin-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    .admin-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .admin-table tbody tr:hover {
        background: #f8f9fa;
    }

    .user-badge {
        display: inline-block;
        padding: 6px 12px;
        background: #e8f4f8;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .user-badge small {
        display: block;
        color: #666;
        font-size: 0.75rem;
        margin-top: 2px;
    }

    .btn-view, .btn-pdf {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: var(--secondary-color);
        color: white;
    }

    .btn-view:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-pdf {
        background: #e74c3c;
        color: white;
    }

    .btn-pdf:hover {
        background: #c0392b;
        transform: translateY(-2px);
    }

    .btn-back {
        display: inline-block;
        padding: 12px 24px;
        background: #6c757d;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>
@endsection
