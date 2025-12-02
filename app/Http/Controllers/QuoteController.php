<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;

class QuoteController extends Controller
{
    public function index()
    {
        $products = Product::where('active', true)->get();
        return view('cotizador.index', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'client_name' => 'required|string|max:255',
                'client_document' => 'nullable|string|max:20',
                'client_email' => 'required|email',
                'client_phone' => 'required|string|max:20',
                'client_company' => 'nullable|string|max:255',
                'exchange_rate' => 'required|numeric|min:0',
                'validity_date' => 'nullable|date',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.discount_percentage' => 'nullable|numeric|min:0|max:100'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            // Calcular totales separados por moneda
            $subtotal_usd = 0;
            $subtotal_pen = 0;
            $discount_usd = 0;
            $discount_pen = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $discount_percentage = $item['discount_percentage'] ?? 0;
                $discount_amount = $subtotal * ($discount_percentage / 100);
                
                if ($product->currency === 'USD') {
                    $subtotal_usd += $subtotal;
                    $discount_usd += $discount_amount;
                } else {
                    $subtotal_pen += $subtotal;
                    $discount_pen += $discount_amount;
                }
            }

            // Calcular subtotales después de descuentos
            $subtotal_after_discount_usd = $subtotal_usd - $discount_usd;
            $subtotal_after_discount_pen = $subtotal_pen - $discount_pen;

            // Convertir USD a PEN y sumar con los PEN
            $subtotal_pen_total = $subtotal_after_discount_pen + ($subtotal_after_discount_usd * $validated['exchange_rate']);
            
            // Calcular IGV (18%)
            $igv_pen = $subtotal_pen_total * 0.18;

            // Total en soles
            $total_pen = $subtotal_pen_total + $igv_pen;

            // Crear cotización
            $quote = Quote::create([
                'user_id' => Auth::id(),
                'client_name' => $validated['client_name'],
                'client_document' => $validated['client_document'],
                'client_email' => $validated['client_email'],
                'client_phone' => $validated['client_phone'],
                'client_company' => $validated['client_company'],
                'exchange_rate' => $validated['exchange_rate'],
                'validity_date' => $validated['validity_date'],
                'subtotal_usd' => $subtotal_usd,
                'subtotal_pen' => $subtotal_pen_total,
                'igv_usd' => 0,
                'igv_pen' => $igv_pen,
                'total_usd' => 0,
                'total_pen' => $total_pen
            ]);

            // Crear items de la cotización
            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                $discount_percentage = $item['discount_percentage'] ?? 0;
                $subtotal = $product->price * $item['quantity'];
                $discount_amount = $subtotal * ($discount_percentage / 100);
                $total = $subtotal - $discount_amount;
                
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'currency' => $product->currency,
                    'subtotal' => $subtotal,
                    'discount_percentage' => $discount_percentage,
                    'discount_amount' => $discount_amount,
                    'total' => $total
                ]);
            }

            return response()->json([
                'success' => true,
                'quote_id' => $quote->id,
                'message' => 'Cotización creada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la cotización: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generatePDF($id)
    {
        $quote = Quote::with(['user', 'items.product'])->findOrFail($id);
        
        $settings = [
            'terms' => Setting::get('terms', 'Condiciones y términos de servicio'),
            'bank_name' => Setting::get('bank_name', ''),
            'bank_account' => Setting::get('bank_account', ''),
            'bank_cci' => Setting::get('bank_cci', ''),
            'company_name' => Setting::get('company_name', 'Hyperzas'),
        ];
        
        $pdf = Pdf::loadView('cotizador.pdf', compact('quote', 'settings'));
        
        return $pdf->download('cotizacion_' . $quote->id . '.pdf');
    }
}
