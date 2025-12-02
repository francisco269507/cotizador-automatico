@extends('layouts.app')

@section('title', 'Configuración General')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }
</style>

<div class="admin-container">
    <h1 style="color: var(--primary-color); margin-bottom: 30px;">Configuración General</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="company_name" class="form-label">Nombre de la Empresa *</label>
                <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', $settings['company_name']) }}" required>
                @error('company_name')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <h3 style="color: var(--primary-color); margin: 30px 0 20px; padding-top: 20px; border-top: 2px solid var(--border-color);">Datos Bancarios</h3>

            <div class="form-group">
                <label for="bank_name" class="form-label">Banco *</label>
                <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ old('bank_name', $settings['bank_name']) }}" placeholder="Ej: BCP, Interbank, BBVA" required>
                @error('bank_name')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bank_account" class="form-label">Número de Cuenta *</label>
                    <input type="text" id="bank_account" name="bank_account" class="form-control" value="{{ old('bank_account', $settings['bank_account']) }}" placeholder="Cuenta bancaria" required>
                    @error('bank_account')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bank_cci" class="form-label">Código CCI *</label>
                    <input type="text" id="bank_cci" name="bank_cci" class="form-control" value="{{ old('bank_cci', $settings['bank_cci']) }}" placeholder="Código CCI (20 dígitos)" required>
                    @error('bank_cci')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h3 style="color: var(--primary-color); margin: 30px 0 20px; padding-top: 20px; border-top: 2px solid var(--border-color);">Condiciones y Términos</h3>

            <div class="form-group">
                <label for="terms" class="form-label">Condiciones *</label>
                <textarea id="terms" name="terms" class="form-control" rows="8" required>{{ old('terms', $settings['terms']) }}</textarea>
                <small style="color: var(--text-light); display: block; margin-top: 8px;">
                    Estas condiciones aparecerán en todas las cotizaciones PDF. Los datos bancarios se agregarán automáticamente al final.
                </small>
                @error('terms')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Guardar Configuración</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
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

    .form-container {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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

    textarea.form-control {
        resize: vertical;
        font-family: inherit;
        line-height: 1.6;
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
