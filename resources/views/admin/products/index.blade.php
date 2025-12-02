@extends('layouts.app')

@section('title', 'Gestión de Productos')

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
        <h1>Gestión de Productos</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Cantidad Default</th>
                    <th>Precio</th>
                    <th>Moneda</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->currency }}</td>
                    <td>
                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @if($product->active)
                                <span class="status-badge status-active">Activo</span>
                            @else
                                <span class="status-badge status-inactive">Inactivo</span>
                            @endif
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-toggle">
                                {{ $product->active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px;">No hay productos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $products->links() }}
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

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
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

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-active {
        background: #28a745;
        color: white;
    }

    .status-inactive {
        background: #dc3545;
        color: white;
    }

    .btn-edit, .btn-toggle {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin-right: 5px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background: var(--secondary-color);
        color: white;
    }

    .btn-edit:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-toggle {
        background: #ffc107;
        color: #333;
    }

    .btn-toggle:hover {
        background: #e0a800;
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
