@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }
</style>

<div class="admin-container">
    <h1 style="color: var(--primary-color); margin-bottom: 30px;">Editar Usuario: {{ $user->name }}</h1>

    <div class="form-container">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Nombre Completo *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico *</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Nueva Contraseña (dejar vacío para no cambiar)</label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Rol *</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuario</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadministrador</option>
                </select>
                @error('role')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Actualizar Usuario</button>
                <a href="{{ route('admin.users') }}" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
    .form-container {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary-color);
    }

    .error-text {
        display: block;
        color: var(--error);
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-submit {
        flex: 1;
        padding: 14px;
        background: var(--secondary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-cancel {
        flex: 1;
        padding: 14px;
        background: #6c757d;
        color: white;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
</style>
@endsection
