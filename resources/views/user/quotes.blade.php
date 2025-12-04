@extends('layouts.app')

@section('title', 'Mis Cotizaciones')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Mis Cotizaciones</h1>
        <a href="{{ route('user.dashboard') }}" class="btn-back">← Volver al Dashboard</a>
    </div>

    <div class="quotes-container">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>RUC</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotes as $quote)
                    <tr>
                        <td>#{{ $quote->id }}</td>
                        <td>{{ $quote->client_name }}</td>
                        <td>{{ $quote->client_ruc }}</td>
                        <td>S/. {{ number_format($quote->total_pen, 2) }}</td>
                        <td>{{ $quote->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('user.quotes.show', $quote->id) }}" class="btn-view">Ver</a>
                            <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">PDF</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            No tienes cotizaciones aún
                            <br>
                            <a href="{{ route('cotizador') }}" style="color: #3A6D82; margin-top: 10px; display: inline-block;">Crear primera cotización</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($quotes->hasPages())
        <div class="pagination-container">
            {{ $quotes->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .admin-header h1 {
        color: #01212E;
        font-size: 2.5rem;
        margin: 0;
    }

    .btn-back {
        background: #3A6D82;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .btn-back:hover {
        background: #01212E;
    }

    .quotes-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        display: inline-block;
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
        display: inline-block;
        margin-right: 5px;
    }

    .btn-view:hover {
        background: #3A6D82;
    }

    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .admin-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .admin-header h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection
