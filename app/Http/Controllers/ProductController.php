<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(): View
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }
}
