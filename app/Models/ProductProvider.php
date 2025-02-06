<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class ProductProvider extends Model
{
    protected $fillable = [
        'product_id',
        'provider_id',
        'url',
        'price_path',
        'currency_symbol_path',
        'json_ld_price_path',
        'json_ld_currency_symbol_path',
        'latest_price',
        'latest_currency',
        'last_checked_at',
    ];

    protected function casts(): array
    {
        return [
            'last_checked_at' => 'datetime',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function priceFormatted(): string
    {
        return Number::currency($this->latest_price, $this->latest_currency, app()->getLocale());
    }
}
