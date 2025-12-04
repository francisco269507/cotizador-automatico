@extends('layouts.app')

@section('title', 'Configuración')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Configuración</h1>
        <a href="{{ route('user.dashboard') }}" class="btn-back">← Volver al Dashboard</a>
    </div>

    <div class="settings-container">
        <h2>Configuración de Cuenta</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario Cambiar Email -->
        <div class="settings-section">
            <h3>Cambiar Correo Electrónico</h3>
            <form action="{{ route('user.settings.email') }}" method="POST" class="settings-form">
                @csrf
                
                <div class="form-group">
                    <label for="email">Nuevo Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password_email">Confirmar con tu Contraseña</label>
                    <input type="password" id="password_email" name="password" required>
                </div>

                <button type="submit" class="btn-submit">Actualizar Correo</button>
            </form>
        </div>

        <hr class="divider">

        <!-- Formulario Cambiar Contraseña -->
        <div class="settings-section">
            <h3>Cambiar Contraseña</h3>
            <form action="{{ route('user.settings.password') }}" method="POST" class="settings-form">
                @csrf
                
                <div class="form-group">
                    <label for="current_password">Contraseña Actual</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" required minlength="6">
                    <small>Mínimo 6 caracteres</small>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required minlength="6">
                </div>

                <button type="submit" class="btn-submit">Actualizar Contraseña</button>
            </form>
        </div>
    </div>
</div>

<style>
    .admin-container {
        max-width: 800px;
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

    .settings-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .settings-container h2 {
        color: #01212E;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .settings-section {
        margin-bottom: 40px;
    }

    .settings-section h3 {
        color: #3A6D82;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .divider {
        border: none;
        border-top: 2px solid #e0e0e0;
        margin: 40px 0;
    }

    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
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

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .settings-form {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #01212E;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #3A6D82;
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #666;
        font-size: 0.875rem;
    }

    .btn-submit {
        background: #3A6D82;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        width: 100%;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #01212E;
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
