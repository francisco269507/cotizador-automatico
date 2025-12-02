<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización Web</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        
        @page {
            size: A4;
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            font-size: 11px;
            position: relative;
            min-height: 100vh;
            width: 210mm;
            max-width: 210mm;
        }

        .page {
            width: 100%;
            max-width: 210mm;
            padding: 0;
            padding-bottom: 80px;
        }

        /* Header principal */
        .main-header {
            background: #01212E;
            color: white;
            padding: 20px 40px;
            text-align: center;
        }

        .main-header h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
        }

        .main-header .subtitle {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Header secundario */
        .secondary-header {
            background: #3A6D82;
            color: white;
            padding: 18px 40px;
            text-align: center;
        }

        .secondary-header h2 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .secondary-header .quote-id {
            font-size: 11px;
            font-weight: 500;
        }

        /* Información del cliente */
        .client-info {
            padding: 25px 40px;
            background: white;
        }

        .client-info h3 {
            font-size: 11px;
            font-weight: 700;
            color: #01212E;
            text-transform: uppercase;
            margin-bottom: 12px;
            letter-spacing: 0.8px;
        }

        .client-details {
            font-size: 11px;
            line-height: 1.7;
        }

        .client-details div {
            margin-bottom: 3px;
        }

        .dates {
            float: right;
            text-align: right;
            font-size: 9px;
        }

        .dates div {
            margin-bottom: 3px;
        }

        /* Tabla de productos */
        .products-section {
            padding: 0 40px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 20px 0;
            page-break-inside: auto;
        }

        .products-table thead {
            background: #01212E;
            color: white;
        }

        .products-table th {
            padding: 12px 8px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.8px;
        }

        .products-table tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .products-table td {
            padding: 12px 8px;
            font-size: 10px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }

        .products-table tbody tr:last-child td {
            border-bottom: 2px solid #01212E;
        }

        .product-name {
            font-weight: 700;
            color: #01212E;
            margin-bottom: 6px;
            font-size: 11px;
        }

        .product-description {
            color: #666;
            font-size: 8px;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .product-includes {
            color: #555;
            font-size: 8px;
            line-height: 1.4;
        }

        .product-includes strong {
            color: #01212E;
            display: block;
            margin-bottom: 2px;
        }

        .product-includes ul {
            margin-left: 15px;
            margin-top: 2px;
        }

        .product-includes li {
            margin-bottom: 1px;
        }

        .brand {
            color: #999;
            font-size: 8px;
            margin-top: 6px;
            font-style: italic;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Totales - siempre al final */
        .totals-section {
            page-break-inside: avoid;
            position: fixed;
            bottom: 80px;
            right: 40px;
        }

        .totals-box {
            float: right;
            width: 380px;
            border: 2px solid #01212E;
            background: #f9f9f9;
        }

        .totals-row {
            display: table;
            width: 100%;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .totals-row:last-child {
            border-bottom: none;
        }

        .totals-label {
            display: table-cell;
            font-weight: 600;
            font-size: 10px;
            color: #333;
        }

        .totals-value {
            display: table-cell;
            text-align: right;
            font-weight: 700;
            font-size: 10px;
            color: #01212E;
        }

        .total-final {
            background: #01212E;
            color: white;
            font-size: 13px;
            padding: 14px 15px;
        }

        .total-final .totals-label,
        .total-final .totals-value {
            color: white;
            font-size: 13px;
        }

        /* Condiciones */
        .conditions {
            clear: both;
            page-break-inside: avoid;
            position: fixed;
            bottom: 80px;
            left: 40px;
            right: 420px;
            background: white;
        }

        .conditions h4 {
            font-size: 11px;
            font-weight: 700;
            color: #01212E;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .conditions ul {
            margin-left: 18px;
            font-size: 10px;
            line-height: 1.7;
        }

        .conditions li {
            margin-bottom: 4px;
        }

        /* Footer - al final de la última página */
        .footer-quote {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #3A6D82;
            color: white;
            padding: 15px 40px;
            text-align: center;
            font-size: 11px;
            font-style: italic;
            font-weight: 500;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .logo-container {
            text-align: center;
            padding: 12px 0;
        }

        .logo-container img {
            height: 50px;
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
        <div class="products-section">
            <table class="products-table">
            <thead>
                <tr>
                    <th style="width: 42%;">DESCRIPCIÓN</th>
                    <th class="text-center" style="width: 8%;">UNIDAD</th>
                    <th class="text-center" style="width: 10%;">MENSUAL</th>
                    <th class="text-center" style="width: 10%;">ANUAL</th>
                    <th class="text-center" style="width: 10%;">ÚNICA</th>
                    <th class="text-center" style="width: 8%;">DESC.%</th>
                    <th class="text-right" style="width: 12%;">TOTAL</th>
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
                    <td class="text-center">
                        @if($item->discount_percentage > 0)
                        <span style="color: #28a745; font-weight: 600;">{{ number_format($item->discount_percentage, 0) }}%</span>
                        @else
                        -
                        @endif
                    </td>
                    <td class="text-right">
                        @if($item->discount_percentage > 0)
                        <div style="text-decoration: line-through; font-size: 9px; color: #999;">
                            @if($item->currency === 'USD')
                                ${{ number_format($item->subtotal, 2) }}
                            @else
                                S/. {{ number_format($item->subtotal, 2) }}
                            @endif
                        </div>
                        @endif
                        <strong style="color: #01212E;">
                            @if($item->currency === 'USD')
                                ${{ number_format($item->total, 2) }}
                            @else
                                S/. {{ number_format($item->total, 2) }}
                            @endif
                        </strong>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <!-- Salto de página antes de totales y condiciones -->
        <div style="page-break-before: always;"></div>

        <!-- Totales -->
        <div class="totals-section clearfix">
            <div class="totals-box">
                @php
                    $total_discount_pen = 0;
                    $subtotal_before_discount = 0;
                    foreach($quote->items as $item) {
                        $subtotal_item = $item->subtotal;
                        if ($item->currency === 'USD') {
                            $subtotal_item *= $quote->exchange_rate;
                        }
                        $subtotal_before_discount += $subtotal_item;
                        $total_discount_pen += $item->discount_amount * ($item->currency === 'USD' ? $quote->exchange_rate : 1);
                    }
                @endphp
                
                @if($total_discount_pen > 0)
                <div class="totals-row">
                    <div class="totals-label">Subtotal antes de descuento:</div>
                    <div class="totals-value">S/. {{ number_format($subtotal_before_discount, 2) }}</div>
                </div>
                <div class="totals-row" style="color: #28a745;">
                    <div class="totals-label">Descuento aplicado:</div>
                    <div class="totals-value">- S/. {{ number_format($total_discount_pen, 2) }}</div>
                </div>
                @endif
                
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
                @php
                    $termsLines = explode("\n", $settings['terms']);
                @endphp
                @foreach($termsLines as $line)
                    @if(trim($line))
                        <li>{{ trim($line) }}</li>
                    @endif
                @endforeach
                <li><strong>Tipo de cambio:</strong> $1 USD = S/. {{ number_format($quote->exchange_rate, 2) }} ({{ $quote->created_at->format('d/m/Y') }})</li>
                <li><strong>Cotización realizada por:</strong> {{ $quote->user->name }}</li>
            </ul>
            
            @if($settings['bank_name'] && $settings['bank_account'])
            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd;">
                <h4 style="margin-bottom: 8px;">Datos para Transferencia Bancaria:</h4>
                <ul style="margin-left: 0; list-style: none;">
                    <li style="margin: 5px 0;"><strong>Banco:</strong> {{ $settings['bank_name'] }}</li>
                    <li style="margin: 5px 0;"><strong>Cuenta:</strong> {{ $settings['bank_account'] }}</li>
                    @if($settings['bank_cci'])
                    <li style="margin: 5px 0;"><strong>CCI:</strong> {{ $settings['bank_cci'] }}</li>
                    @endif
                    <li style="margin: 5px 0;"><strong>Titular:</strong> {{ $settings['company_name'] }}</li>
                </ul>
            </div>
            @endif
        </div>
        
        <!-- Footer - En la última página -->
        <div class="footer-quote">
            "Da el siguiente paso ahora - Transforma tu presencia digital con Hyperzas"
        </div>
    </div>
</body>
</html>
