@extends('layouts.app')

@section('title', 'Cotizador - Hyperzas')

@section('styles')
<style>
    .container {
        max-width: 1400px;
        padding: 30px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        border-radius: 12px;
    }

    .page-header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .cotizador-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .form-section {
        background: var(--white);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--secondary-color);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-label.required::after {
        content: " *";
        color: var(--error);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(58, 109, 130, 0.1);
    }

    .exchange-rate-group {
        background: var(--light-bg);
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed var(--secondary-color);
    }

    .exchange-rate-group .form-control {
        font-size: 1.3rem;
        font-weight: 700;
        text-align: center;
        color: var(--primary-color);
    }

    /* Tabla de productos */
    .products-table {
        width: 100%;
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .table-header {
        background: var(--primary-color);
        color: var(--white);
        padding: 20px;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .table-content {
        max-height: 600px;
        overflow-y: auto;
    }

    .product-item {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 20px;
        align-items: center;
        transition: background 0.3s ease;
    }

    .product-item:hover {
        background: var(--light-bg);
    }

    .product-checkbox {
        width: 24px;
        height: 24px;
        cursor: pointer;
        accent-color: var(--secondary-color);
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.05rem;
        margin-bottom: 5px;
    }

    .product-details {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .product-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-type {
        background: #e8f4f8;
        color: var(--secondary-color);
    }

    .badge-price {
        background: #d4edda;
        color: #155724;
    }

    .badge-duration {
        background: #fff3cd;
        color: #856404;
    }

    .product-description {
        color: var(--text-light);
        font-size: 0.9rem;
        margin-top: 8px;
        line-height: 1.5;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--light-bg);
        padding: 8px;
        border-radius: 8px;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        border: none;
        background: var(--secondary-color);
        color: var(--white);
        border-radius: 6px;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .quantity-btn:hover {
        background: var(--accent-color);
        transform: scale(1.1);
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        padding: 6px;
        font-weight: 700;
        font-size: 1rem;
    }

    /* Resumen */
    .summary-section {
        background: var(--white);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .summary-row.total {
        border-top: 3px solid var(--primary-color);
        border-bottom: none;
        padding-top: 20px;
        margin-top: 10px;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .summary-label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-value {
        font-weight: 700;
        color: var(--secondary-color);
    }

    .currency-group {
        margin-bottom: 20px;
    }

    .currency-header {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
        padding: 10px;
        background: var(--light-bg);
        border-radius: 8px;
    }

    .btn-generate {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        color: var(--white);
        border: none;
        border-radius: 10px;
        font-size: 1.2rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(58, 109, 130, 0.3);
    }

    .btn-generate:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(58, 109, 130, 0.4);
    }

    .btn-generate:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .selected-count {
        background: var(--secondary-color);
        color: var(--white);
        padding: 10px 20px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        margin-bottom: 20px;
    }

    @media (max-width: 1200px) {
        .cotizador-grid {
            grid-template-columns: 1fr;
        }

        .summary-section {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .product-item {
            grid-template-columns: auto 1fr;
        }

        .quantity-control {
            grid-column: 1 / -1;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Cotizador de Servicios</h1>
        <p>Genera cotizaciones profesionales con cálculos automáticos</p>
    </div>

    <div class="cotizador-grid">
        <!-- Columna izquierda: Formulario y Productos -->
        <div>
            <!-- Datos del Cliente -->
            <div class="form-section">
                <h2 class="section-title">Datos del Cliente</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Nombre Completo</label>
                        <input type="text" id="client_name" class="form-control" placeholder="Ej: Juan Pérez">
                    </div>
                    <div class="form-group">
                        <label class="form-label">DNI / RUC</label>
                        <input type="text" id="client_document" class="form-control" placeholder="Opcional">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Correo Electrónico</label>
                        <input type="email" id="client_email" class="form-control" placeholder="cliente@ejemplo.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Teléfono</label>
                        <input type="text" id="client_phone" class="form-control" placeholder="999 999 999">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre de Empresa</label>
                    <input type="text" id="client_company" class="form-control" placeholder="Opcional">
                </div>
            </div>

            <!-- Tipo de Cambio -->
            <div class="form-section exchange-rate-group">
                <h2 class="section-title">Tipo de Cambio y Vigencia</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Dólar (USD) a Soles (PEN)</label>
                        <input type="number" id="exchange_rate" class="form-control" placeholder="3.71" step="0.0001" value="3.71">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Vigencia</label>
                        <input type="date" id="validity_date" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Lista de Productos -->
            <div class="products-table">
                <div class="table-header">
                    Servicios Disponibles
                </div>
                <div class="table-content">
                    @foreach($products as $product)
                    <div class="product-item">
                        <input type="checkbox" class="product-checkbox" data-product-id="{{ $product->id }}">
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-details">
                                <span class="product-badge badge-type">{{ $product->type }}</span>
                                <span class="product-badge badge-price">{{ number_format($product->price, 2) }} {{ $product->currency }}</span>
                                @if($product->duration)
                                <span class="product-badge badge-duration">{{ $product->duration }} - {{ $product->billing }}</span>
                                @endif
                            </div>
                            @if($product->details)
                            <div class="product-description">{{ $product->details }}</div>
                            @endif
                        </div>
                        <div class="quantity-control" style="display: none;" data-quantity-control="{{ $product->id }}">
                            <button type="button" class="quantity-btn" onclick="updateQuantity({{ $product->id }}, -1)">−</button>
                            <input type="number" class="quantity-input" value="{{ $product->quantity }}" min="1" 
                                   data-quantity="{{ $product->id }}" onchange="updateQuantityInput({{ $product->id }})">
                            <button type="button" class="quantity-btn" onclick="updateQuantity({{ $product->id }}, 1)">+</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Columna derecha: Resumen -->
        <div>
            <div class="summary-section">
                <h2 class="section-title">Resumen de Cotización</h2>
                
                <div class="selected-count">
                    <span id="selected-count">0</span> producto(s) seleccionado(s)
                </div>

                <div id="summary-content">
                    <p style="text-align: center; color: var(--text-light); padding: 40px 20px;">
                        Selecciona productos para ver el resumen
                    </p>
                </div>

                <button type="button" class="btn-generate" id="btn-generate" onclick="generateQuote()" disabled>
                    Generar Cotización PDF
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const products = @json($products);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let selectedProducts = new Map();

    // Inicializar event listeners
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const productId = parseInt(this.dataset.productId);
            const quantityControl = document.querySelector(`[data-quantity-control="${productId}"]`);
            
            if (this.checked) {
                const product = products.find(p => p.id === productId);
                const quantityInput = document.querySelector(`[data-quantity="${productId}"]`);
                selectedProducts.set(productId, {
                    ...product,
                    quantity: parseInt(quantityInput.value)
                });
                quantityControl.style.display = 'flex';
            } else {
                selectedProducts.delete(productId);
                quantityControl.style.display = 'none';
            }
            
            updateSummary();
        });
    });

    function updateQuantity(productId, change) {
        const input = document.querySelector(`[data-quantity="${productId}"]`);
        let newValue = parseInt(input.value) + change;
        if (newValue < 1) newValue = 1;
        input.value = newValue;
        
        if (selectedProducts.has(productId)) {
            const product = selectedProducts.get(productId);
            product.quantity = newValue;
            selectedProducts.set(productId, product);
            updateSummary();
        }
    }

    function updateQuantityInput(productId) {
        const input = document.querySelector(`[data-quantity="${productId}"]`);
        let value = parseInt(input.value);
        if (isNaN(value) || value < 1) value = 1;
        input.value = value;
        
        if (selectedProducts.has(productId)) {
            const product = selectedProducts.get(productId);
            product.quantity = value;
            selectedProducts.set(productId, product);
            updateSummary();
        }
    }

    function updateSummary() {
        const exchangeRate = parseFloat(document.getElementById('exchange_rate').value) || 3.71;
        const count = selectedProducts.size;
        
        document.getElementById('selected-count').textContent = count;
        document.getElementById('btn-generate').disabled = count === 0;
        
        if (count === 0) {
            document.getElementById('summary-content').innerHTML = `
                <p style="text-align: center; color: var(--text-light); padding: 40px 20px;">
                    Selecciona productos para ver el resumen
                </p>
            `;
            return;
        }

        let subtotal_usd = 0;
        let subtotal_pen = 0;

        selectedProducts.forEach(product => {
            const subtotal = product.price * product.quantity;
            if (product.currency === 'USD') {
                subtotal_usd += subtotal;
            } else {
                subtotal_pen += subtotal;
            }
        });

        // NO mezclar monedas
        // Solo convertir USD a PEN y sumar con los PEN
        const subtotal_pen_total = subtotal_pen + (subtotal_usd * exchangeRate);

        // Calcular IGV (18%) solo en soles
        const igv_pen = subtotal_pen_total * 0.18;

        // Total en soles
        const total_pen = subtotal_pen_total + igv_pen;

        document.getElementById('summary-content').innerHTML = `
            <div class="currency-group">
                <div class="currency-header">💰 Resumen en Soles (PEN)</div>
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">S/ ${subtotal_pen_total.toFixed(2)}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">IGV (18%)</span>
                    <span class="summary-value">S/ ${igv_pen.toFixed(2)}</span>
                </div>
                <div class="summary-row total">
                    <span class="summary-label">Total PEN</span>
                    <span class="summary-value">S/ ${total_pen.toFixed(2)}</span>
                </div>
            </div>
        `;
    }

    // Actualizar resumen cuando cambia el tipo de cambio
    document.getElementById('exchange_rate').addEventListener('input', updateSummary);

    async function generateQuote() {
        // Validar datos del cliente
        const clientName = document.getElementById('client_name').value.trim();
        const clientEmail = document.getElementById('client_email').value.trim();
        const clientPhone = document.getElementById('client_phone').value.trim();
        const exchangeRate = parseFloat(document.getElementById('exchange_rate').value);

        if (!clientName || !clientEmail || !clientPhone) {
            alert('Por favor completa todos los campos obligatorios del cliente (Nombre, Email y Teléfono)');
            return;
        }

        if (!exchangeRate || exchangeRate <= 0) {
            alert('Por favor ingresa un tipo de cambio válido');
            return;
        }

        if (selectedProducts.size === 0) {
            alert('Por favor selecciona al menos un producto');
            return;
        }

        const data = {
            client_name: clientName,
            client_document: document.getElementById('client_document').value.trim(),
            client_email: clientEmail,
            client_phone: clientPhone,
            client_company: document.getElementById('client_company').value.trim(),
            exchange_rate: exchangeRate,
            validity_date: document.getElementById('validity_date').value,
            items: Array.from(selectedProducts.values()).map(p => ({
                product_id: p.id,
                quantity: p.quantity
            }))
        };

        try {
            const response = await fetch('{{ route("cotizacion.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                // Abrir el PDF en una nueva pestaña
                window.open(`/cotizacion/${result.quote_id}/pdf`, '_blank');
                
                // Opcional: Limpiar el formulario
                if (confirm('Cotización generada exitosamente. ¿Deseas crear una nueva cotización?')) {
                    location.reload();
                }
            } else {
                alert('Error al generar la cotización: ' + (result.message || 'Error desconocido'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al generar la cotización. Por favor intenta de nuevo.');
        }
    }
</script>
@endsection
