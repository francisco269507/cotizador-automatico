<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización Web</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 11px;
        }

        .page {
            width: 100%;
            padding: 0;
        }

        /* Header principal */
        .main-header {
            background: #01212E;
            color: white;
            padding: 25px 40px;
            text-align: center;
        }

        .main-header h1 {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .main-header .subtitle {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        /* Header secundario */
        .secondary-header {
            background: #3A6D82;
            color: white;
            padding: 20px 40px;
            text-align: center;
        }

        .secondary-header h2 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .secondary-header .quote-id {
            font-size: 12px;
            font-weight: 400;
        }

        /* Información del cliente */
        .client-info {
            padding: 30px 40px;
            background: white;
        }

        .client-info h3 {
            font-size: 11px;
            font-weight: 700;
            color: #01212E;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .client-details {
            font-size: 11px;
            line-height: 1.8;
        }

        .client-details div {
            margin-bottom: 3px;
        }

        .dates {
            float: right;
            text-align: right;
            font-size: 10px;
        }

        .dates div {
            margin-bottom: 3px;
        }

        /* Tabla de productos */
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .products-table thead {
            background: #01212E;
            color: white;
        }

        .products-table th {
            padding: 10px 8px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .products-table td {
            padding: 15px 8px;
            font-size: 10px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }

        .products-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-name {
            font-weight: 700;
            color: #01212E;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .product-description {
            color: #666;
            font-size: 9px;
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .product-includes {
            color: #555;
            font-size: 9px;
            line-height: 1.5;
        }

        .product-includes strong {
            color: #01212E;
            display: block;
            margin-bottom: 3px;
        }

        .product-includes ul {
            margin-left: 15px;
            margin-top: 3px;
        }

        .product-includes li {
            margin-bottom: 2px;
        }

        .brand {
            color: #999;
            font-size: 9px;
            margin-top: 8px;
            font-style: italic;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Totales */
        .totals-section {
            margin-top: 30px;
            padding: 0 40px 40px 40px;
        }

        .totals-box {
            float: right;
            width: 350px;
            border: 2px solid #e0e0e0;
        }

        .totals-row {
            display: table;
            width: 100%;
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .totals-row:last-child {
            border-bottom: none;
        }

        .totals-label {
            display: table-cell;
            font-weight: 600;
            font-size: 11px;
            color: #333;
        }

        .totals-value {
            display: table-cell;
            text-align: right;
            font-weight: 700;
            font-size: 11px;
            color: #01212E;
        }

        .total-final {
            background: #01212E;
            color: white;
            font-size: 14px;
            padding: 12px 15px;
        }

        .total-final .totals-label,
        .total-final .totals-value {
            color: white;
        }

        /* Condiciones */
        .conditions {
            clear: both;
            padding: 30px 40px;
            background: white;
            border-top: 1px solid #e0e0e0;
        }

        .conditions h4 {
            font-size: 12px;
            font-weight: 700;
            color: #01212E;
            margin-bottom: 12px;
        }

        .conditions ul {
            margin-left: 18px;
            font-size: 10px;
            line-height: 1.8;
        }

        .conditions li {
            margin-bottom: 5px;
        }

        /* Footer */
        .footer-quote {
            background: #3A6D82;
            color: white;
            padding: 18px 40px;
            text-align: center;
            font-size: 11px;
            font-style: italic;
            margin-top: 20px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .logo-container {
            text-align: center;
            padding: 15px 0;
        }

        .logo-container img {
            height: 60px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header Principal -->
        <div class="main-header">
            <div class="logo-container">
                <img src="{{ public_path('images/hyperzas-logo.png') }}" alt="Hyperzas Logo">
            </div>
        </div>

        <!-- Header Secundario -->
        <div class="secondary-header">
            <h2>
                COTIZACIÓN
                @if($quote->client_company)
                "{{ strtoupper($quote->client_company) }}"
                @endif
            </h2>
        </div>

        <!-- Información del Cliente -->
        <div class="client-info clearfix">
            <div style="width: 60%; float: left;">
                <h3>DATOS DEL CLIENTE:</h3>
                <div class="client-details">
                    <div><strong>{{ strtoupper($quote->client_name) }}</strong></div>
                    @if($quote->client_company)
                    <div>{{ strtoupper($quote->client_company) }}</div>
                    @endif
                    <div>Email: {{ $quote->client_email }}</div>
                    <div>Teléfono: {{ $quote->client_phone }}</div>
                </div>
            </div>
            <div class="dates">
                <div><strong>Fecha:</strong> {{ $quote->created_at->format('d/m/Y') }}</div>
                @if($quote->validity_date)
                <div><strong>Vigencia:</strong> {{ \Carbon\Carbon::parse($quote->validity_date)->format('Y-m-d') }}</div>
                @endif
            </div>
        </div>

        <!-- Tabla de Productos -->
        <table class="products-table">
            <thead>
                <tr>
                    <th style="width: 52%;">DESCRIPCIÓN</th>
                    <th class="text-center" style="width: 8%;">UNIDAD</th>
                    <th class="text-center" style="width: 10%;">MENSUAL</th>
                    <th class="text-center" style="width: 10%;">ANUAL</th>
                    <th class="text-center" style="width: 10%;">ÚNICA</th>
                    <th class="text-right" style="width: 10%;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quote->items as $item)
                <tr>
                    <td>
                        <div class="product-name">{{ $item->product->name }}</div>
                        @if($item->product->details)
                        <div class="product-description">{{ $item->product->details }}</div>
                        @endif
                        <div class="brand">Marca: Hyperzas</div>
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-center">
                        @if($item->product->billing === 'Mensual')
                        {{ number_format($item->unit_price, 2) }} {{ $item->currency }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->product->billing === 'Anual')
                        {{ number_format($item->unit_price, 2) }} {{ $item->currency }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->product->billing === 'Única')
                        {{ number_format($item->unit_price, 2) }} {{ $item->currency }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="text-right">
                        <strong>
                            @if($item->currency === 'USD')
                                ${{ number_format($item->subtotal, 2) }}
                            @else
                                S/. {{ number_format($item->subtotal, 2) }}
                            @endif
                        </strong>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totales -->
        <div class="totals-section clearfix">
            <div class="totals-box">
                <div class="totals-row">
                    <div class="totals-label">Subtotal:</div>
                    <div class="totals-value">S/. {{ number_format($quote->subtotal_pen, 2) }}</div>
                </div>
                <div class="totals-row">
                    <div class="totals-label">IGV (18%):</div>
                    <div class="totals-value">S/. {{ number_format($quote->igv_pen, 2) }}</div>
                </div>
                <div class="totals-row total-final">
                    <div class="totals-label">TOTAL:</div>
                    <div class="totals-value">S/. {{ number_format($quote->total_pen, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Condiciones -->
        <div class="conditions">
            <h4>Condiciones:</h4>
            <ul>
                <li><strong>Método de pago:</strong> Transferencia bancaria, Stripe, Tarjeta de crédito o débito</li>
                <li><strong>Moneda:</strong> Precios en Soles Peruanos (PEN) incluyen IGV</li>
                <li><strong>Tipo de cambio:</strong> $1 USD = S/. {{ number_format($quote->exchange_rate, 2) }} ({{ $quote->created_at->format('d/m/Y') }})</li>
                <li><strong>Cotización realizada por:</strong> {{ $quote->user->name }}</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer-quote">
            "Da el siguiente paso ahora - Transforma tu presencia digital con Hyperzas"
        </div>
    </div>
</body>
</html>
