<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\View;


class ProductController extends Controller
{
    public function index($slug = null)
    {
        $products = product::all(); // Utiliser $products au lieu de $product
        return view('product.index', compact('products')); // Utiliser 'products' au lieu de 'product'
    }
}
