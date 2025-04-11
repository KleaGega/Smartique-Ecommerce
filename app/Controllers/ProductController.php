<?php

namespace App\Controllers;

use App\Core\{Request, View};
use App\Models\Product;

class ProductController extends Controller
{
    protected int $count;

    function __construct()
    {
        // Count total number of products for pagination
        $this->count = Product::all()->count();
    }
    // Display a list of products with pagination and optional filtering
    public function index(): View
    {
        list($products, $links) = paginate(8, $this->count, 'products');
        $q = '';
        $sort = '';
         // Check if there are filters in the request (search and sort)
        if (Request::has('get')) {
            $request = Request::get('get');
            $query = Product::query();
             // Search products by name
            if (isset($request->key) && !empty($request->key)) {
                $query = $query->where('name', 'LIKE', '%' . $request->key . '%');
                $q = $request->key;
            }
             // Search products by price
            if (isset($request->sort) && !empty($request->sort)) {
                $query = $query->orderBy('price', $request->sort);
                $sort = $request->sort;
            }
            
            if (!empty($q) || !empty($sort)) {
                $products = $query->get();
            }
        }
         // Render the product list view
        return View::render()->blade('client.products.index', compact('products', 'links', 'q', 'sort'));
    }

    //Show details of a single product
    public function show($id): View
    {
        $product = Product::query()->where('id', $id)->first();
        // Get similar products based on category
        $similarProducts = Product::query()->where('category_id', $product->category->id)->orderBy('id', 'DESC')->limit(4)->get();

        return View::render()->blade('client.products.show', compact('product', 'similarProducts'));
    }
}
