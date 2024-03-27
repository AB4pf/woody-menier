<?php
namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\Product;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = categories::all();
        return view('category.index', compact('categories'));
    }
    public function showProducts($slug)
    {
        // Récupérer la catégorie en fonction du slug
        $category = categories::where('slug', $slug)->firstOrFail();

        // Récupérer les produits associés à cette catégorie
        $products = $category->products;

        // Autres opérations si nécessaire

        // Retourner la vue avec les produits de la catégorie
        return view('category.show', compact('category', 'products'));
    }
}

