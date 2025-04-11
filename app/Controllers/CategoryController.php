<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\{Category, Product};

class CategoryController extends Controller
{
    // Show products under a specific category
    public function show($id): View
    {
        $category = Category::query()->where('id', $id)->first();
    // Get all products related to this category
        $products = Product::query()->where('category_id', $category->id)->get();
    // Return the view with category and products
        return View::render()->blade('client.categories.show', compact('category', 'products'));
    }
}
