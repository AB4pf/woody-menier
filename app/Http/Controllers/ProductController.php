<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\View;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null)
    {
        $products = Product::all(); // Utiliser $products au lieu de $product
        $categories = categories::all();
        return view('product.index', compact('products', 'categories')); // Utiliser 'products' au lieu de 'product'
    }

    public function category($slug)
    {
        // Récupérez la catégorie en fonction du slug
        $category = categories::where('slug', $slug)->firstOrFail();
        // Récupérez les produits associés à cette catégorie
        $products = $category->product;
        $categories = Category::all();
        return view('category.index', compact('products','categories'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string',
            'image' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);
        $products = new Product();
        $products->categories_id = $request->categories_id;
        $products->name = $request->name;
        $products->description = $request->description;
        $products->image = $request->image;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->save();
        return back()->with('message', "Le produit a bien été créée !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products)
    {
        return view('product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        return view('product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $products)
    {
        $data = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,'. $products->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);
        $products->categories_id = $request->categories_id;
        $products->name = $request->name;
        $products->description = $request->description;
        $products->image = $request->image;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->save();
        return back()->with('message', "La sneakers a bien été modifiée !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        $products->delete();
    }
}
