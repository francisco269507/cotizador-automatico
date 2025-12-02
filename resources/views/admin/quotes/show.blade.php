@extends('layouts.app')

@section('title', 'Detalle Cotización #' . $quote->id)

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }
</style>

<div class="admin-container">
    <div class="page-header-admin">
        <h1>Cotización #{{ $quote->id }}</h1>
        <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="quote-details">
        <div class="detail-section">
            <h2>Información del Cliente</h2>
            <div class="detail-grid">
                <div class="detail-item">
                    <strong>Nombre:</strong>
                    <span>{{ $quote->client_name }}</span>
                </div>
                <div class="detail-item">
                    <strong>Documento:</strong>
                    <span>{{ $quote->client_document ?: 'N/A' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Email:</strong>
                    <span>{{ $quote->client_email }}</span>
                </div>
                <div class="detail-item">
                    <strong>Teléfono:</strong>
                    <span>{{ $quote->client_phone }}</span>
                </div>
                @if($quote->client_company)
                <div class="detail-item">
                    <strong>Empresa:</strong>
                    <span>{{ $quote->client_company }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="detail-section">
            <h2>Información de la Cotización</h2>
            <div class="detail-grid">
                <div class="detail-item">
                    <strong>Generado por:</strong>
                    <span>{{ $quote->user->name }} ({{ $quote->user->role }})</span>
                </div>
                <div class="detail-item">
                    <strong>Fecha de Creación:</strong>
                    <span>{{ $quote->created_at->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="detail-item">
                    <strong>Tipo de Cambio:</strong>
                    <span>S/. {{ number_format($quote->exchange_rate, 4) }}</span>
                </div>
                @if($quote->validity_date)
                <div class="detail-item">
                    <strong>Vigencia:</strong>
                    <span>{{ \Carbon\Carbon::parse($quote->validity_date)->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="detail-section">
            <h2>Productos/Servicios</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quote->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product->name }}</strong>
                            @if($item->product->details)
                            <br><small style="color: #666;">{{ $item->product->details }}</small>
                            @endif
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit_price }} {{ $item->currency }}</td>
                        <td>
                            @if($item->discount_percentage > 0)
                            <span style="color: #28a745; font-weight: 600;">{{ $item->discount_percentage }}%</span>
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ number_format($item->subtotal, 2) }} {{ $item->currency }}</td>
                        <td><strong>{{ number_format($item->total, 2) }} {{ $item->currency }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="detail-section">
            <h2>Resumen de Totales</h2>
            <div class="totals-summary">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <strong>S/. {{ number_format($quote->subtotal_pen, 2) }}</strong>
                </div>
                <div class="total-row">
                    <span>IGV (18%):</span>
                    <strong>S/. {{ number_format($quote->igv_pen, 2) }}</strong>
                </div>
                <div class="total-row total-final">
                    <span>TOTAL:</span>
                    <strong>S/. {{ number_format($quote->total_pen, 2) }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('admin.quotes') }}" class="btn-back">← Volver a Cotizaciones</a>
    </div>
</div>

<style>
    .quote-details {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .detail-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .detail-section h2 {
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border-color);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail-item strong {
        color: var(--text-dark);
        font-size: 0.9rem;
    }

    .detail-item span {
        color: var(--text-light);
        font-size: 1rem;
    }

    .totals-summary {
        max-width: 400px;
        margin-left: auto;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .total-final {
        background: var(--primary-color);
        color: white;
        padding: 15px 20px;
        margin-top: 10px;
        border-radius: 8px;
        font-size: 1.2rem;
    }

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

    .btn-pdf {
        display: inline-block;
        padding: 12px 24px;
        background: #e74c3c;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-pdf:hover {
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table thead {
        background: var(--primary-color);
        color: white;
    }

    table th, table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    table tbody tr:hover {
        background: #f8f9fa;
    }

</style>
@endsection
