<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];

    public function providers(): HasMany
    {
        return $this->hasMany(ProductProvider::class);
    }

    public function bestPrice(): ProductProvider
    {
        return $this->providers->sortBy('latest_price')->first();
    }
}
