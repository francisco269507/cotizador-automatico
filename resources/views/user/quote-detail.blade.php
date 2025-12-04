@extends('layouts.app')

@section('title', 'Cotización #' . $quote->id)

@section('content')
<div class="admin-container">
    <div class="page-header-admin">
        <h1>Cotización #{{ $quote->id }}</h1>
        <div class="header-actions">
            <a href="{{ route('user.quotes') }}" class="btn-back">← Volver</a>
            <a href="{{ route('cotizacion.pdf', $quote->id) }}" class="btn-pdf" target="_blank">Descargar PDF</a>
        </div>
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
                    <span>{{ $quote->user->name }}</span>
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
            <div class="table-responsive">
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
                            <td>{{ number_format($item->unit_price, 2) }} {{ $item->currency }}</td>
                            <td>
                                @if($item->discount_percentage > 0)
                                <span style="color: #28a745; font-weight: 600;">{{ $item->discount_percentage }}%</span>
                                @else
                                <span style="color: #999;">-</span>
                                @endif
                            </td>
                            <td>{{ number_format($item->subtotal, 2) }} {{ $item->currency }}</td>
                            <td>{{ number_format($item->total, 2) }} {{ $item->currency }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="detail-section totals-section">
            <h2>Resumen</h2>
            <div class="totals-grid">
                <div class="total-row">
                    <strong>Subtotal:</strong>
                    <span>S/. {{ number_format($quote->subtotal_pen, 2) }}</span>
                </div>
                <div class="total-row">
                    <strong>IGV (18%):</strong>
                    <span>S/. {{ number_format($quote->igv_pen, 2) }}</span>
                </div>
                <div class="total-row total-final">
                    <strong>Total:</strong>
                    <span>S/. {{ number_format($quote->total_pen, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }

    .page-header-admin {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid #3A6D82;
    }

    .page-header-admin h1 {
        color: #01212E;
        font-size: 2.5rem;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-back {
        background: #01212E;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #3A6D82;
    }

    .btn-pdf {
        background: #e74c3c;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
        font-weight: 600;
    }

    .btn-pdf:hover {
        background: #c0392b;
    }

    .quote-details {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .detail-section {
        padding: 30px;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    .detail-section h2 {
        color: #01212E;
        font-size: 1.5rem;
        margin-bottom: 20px;
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
        color: #3A6D82;
        font-size: 0.9rem;
    }

    .detail-item span {
        color: #01212E;
        font-size: 1.1rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .admin-table thead {
        background: #01212E;
        color: white;
    }

    .admin-table th,
    .admin-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .admin-table tbody tr:hover {
        background: #f5f5f5;
    }

    .totals-section {
        background: #f8f9fa;
    }

    .totals-grid {
        max-width: 400px;
        margin-left: auto;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .total-row strong {
        color: #01212E;
    }

    .total-row span {
        color: #01212E;
        font-size: 1.1rem;
    }

    .total-final {
        border-top: 3px solid #3A6D82;
        border-bottom: none;
        padding-top: 15px;
        margin-top: 10px;
    }

    .total-final strong,
    .total-final span {
        font-size: 1.5rem;
        color: #01212E;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .page-header-admin {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .page-header-admin h1 {
            font-size: 2rem;
        }

        .header-actions {
            width: 100%;
            flex-direction: column;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
