<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    const Website1 = 1;

    const Website2 = 2;

    const Website3 = 3;

    protected $fillable = [
        'name',
        'logo_url',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductProvider::class);
    }
}
