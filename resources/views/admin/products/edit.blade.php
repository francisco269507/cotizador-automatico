@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }
</style>

<div class="admin-container">
    <h1 style="color: var(--primary-color); margin-bottom: 30px;">Editar Producto: {{ $product->name }}</h1>

    <div class="form-container">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Nombre del Producto *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                @error('name')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="type" class="form-label">Tipo de Producto *</label>
                    <input type="text" id="type" name="type" class="form-control" value="{{ old('type', $product->type) }}" required>
                    @error('type')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity" class="form-label">Cantidad por Defecto *</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" min="1" required>
                    @error('quantity')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price" class="form-label">Precio *</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                    @error('price')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="currency" class="form-label">Moneda *</label>
                    <select id="currency" name="currency" class="form-control" required>
                        <option value="PEN" {{ old('currency', $product->currency) == 'PEN' ? 'selected' : '' }}>PEN (Soles)</option>
                        <option value="USD" {{ old('currency', $product->currency) == 'USD' ? 'selected' : '' }}>USD (Dólares)</option>
                    </select>
                    @error('currency')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duration" class="form-label">Duración</label>
                    <input type="text" id="duration" name="duration" class="form-control" value="{{ old('duration', $product->duration) }}" placeholder="Ej: 1 Mes, 1 Año, -">
                    @error('duration')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="billing" class="form-label">Facturación</label>
                    <input type="text" id="billing" name="billing" class="form-control" value="{{ old('billing', $product->billing) }}" placeholder="Ej: Mensual, Anual, Única">
                    @error('billing')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="details" class="form-label">Descripción/Detalles</label>
                <textarea id="details" name="details" class="form-control" rows="4">{{ old('details', $product->details) }}</textarea>
                @error('details')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="active" class="form-label">Estado *</label>
                <select id="active" name="active" class="form-control" required>
                    <option value="1" {{ old('active', $product->active) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('active', $product->active) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('active')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Actualizar Producto</button>
                <a href="{{ route('admin.products') }}" class="btn-cancel">Cancelar</a>
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
