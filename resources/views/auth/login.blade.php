@extends('layouts.app')

@section('title', 'Iniciar Sesión - Hyperzas')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #01212E 0%, #3A6D82 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        display: flex;
        max-width: 1100px;
        width: 100%;
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .login-left {
        flex: 1;
        background: linear-gradient(135deg, #01212E 0%, #1a3a48 100%);
        color: var(--white);
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-left h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .login-left .brand-name {
        color: var(--accent-color);
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 30px;
    }

    .login-left p {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, 0.9);
    }

    .features {
        list-style: none;
        margin-top: 20px;
    }

    .features li {
        padding: 12px 0;
        display: flex;
        align-items: center;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.95);
    }

    .features li::before {
        content: "✓";
        background: var(--secondary-color);
        color: var(--white);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-weight: bold;
        flex-shrink: 0;
    }

    .login-right {
        flex: 1;
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .login-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 4px 15px rgba(58, 109, 130, 0.3);
    }

    .login-icon svg {
        width: 40px;
        height: 40px;
        fill: var(--white);
    }

    .login-header h2 {
        font-size: 1.8rem;
        color: var(--primary-color);
        margin-bottom: 8px;
    }

    .login-header p {
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .form-label svg {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        fill: var(--secondary-color);
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--light-bg);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary-color);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(58, 109, 130, 0.1);
    }

    .form-control.error {
        border-color: var(--error);
    }

    .error-message {
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
    }

    .error-message::before {
        content: "⚠";
        margin-right: 5px;
    }

    .btn-login {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        color: var(--white);
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 4px 15px rgba(58, 109, 130, 0.3);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(58, 109, 130, 0.4);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    @media (max-width: 968px) {
        .login-container {
            flex-direction: column;
        }

        .login-left, .login-right {
            padding: 40px;
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-left">
        <h1>Sistema de Cotizaciones</h1>
        <div class="brand-name">Hyperzas</div>
        <p>Genera cotizaciones profesionales para nuestros servicios de hosting, tiendas virtuales y desarrollo web de manera rápida y eficiente.</p>
        
        <ul class="features">
            <li>Cotizaciones instantáneas en PDF</li>
            <li>Múltiples servicios y configuraciones</li>
            <li>Cálculos automáticos con IGV</li>
            <li>Tipo de cambio actualizado</li>
        </ul>
    </div>

    <div class="login-right">
        <div class="login-header">
            <div class="login-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h2>Iniciar Sesión</h2>
            <p>Accede al sistema de cotizaciones</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    Correo Electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control @error('email') error @enderror" 
                    placeholder="usuario@hyperzas.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') error @enderror" 
                    placeholder="Ingresa tu contraseña"
                    required
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Iniciar Sesión
            </button>
        </form>
    </div>
</div>
@endsection
