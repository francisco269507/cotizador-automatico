<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'type',
        'quantity',
        'price',
        'currency',
        'duration',
        'billing',
        'details',
        'active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean'
    ];

    public function quoteItems()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
