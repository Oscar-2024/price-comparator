<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class PriceComparatorController extends Controller
{
    public function __invoke(int $productId): View
    {
        $product = Product::with(['providers' => function ($query) {
            $query->whereNotNull('latest_price')->orderBy('latest_price', 'asc');
        }])->find($productId);

        return view('products.price-comparator', compact('product'));
    }
}
