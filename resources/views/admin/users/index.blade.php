@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

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
        <h1>Gestión de Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">+ Crear Usuario</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge role-{{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Editar</a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px;">No hay usuarios registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $users->links() }}
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

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
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

    .role-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .role-superadmin {
        background: #ff6b6b;
        color: white;
    }

    .role-admin {
        background: #4ecdc4;
        color: white;
    }

    .role-user {
        background: #95a5a6;
        color: white;
    }

    .btn-primary {
        background: var(--secondary-color);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-edit, .btn-delete {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin-right: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: var(--secondary-color);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: var(--error);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
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
