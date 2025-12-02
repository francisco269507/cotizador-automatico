<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'user_id',
        'client_name',
        'client_document',
        'client_email',
        'client_phone',
        'client_company',
        'exchange_rate',
        'validity_date',
        'subtotal_usd',
        'subtotal_pen',
        'igv_usd',
        'igv_pen',
        'total_usd',
        'total_pen'
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:4',
        'subtotal_usd' => 'decimal:2',
        'subtotal_pen' => 'decimal:2',
        'igv_usd' => 'decimal:2',
        'igv_pen' => 'decimal:2',
        'total_usd' => 'decimal:2',
        'total_pen' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
