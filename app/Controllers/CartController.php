<?php

namespace App\Controllers;

use App\Core\{Request, Session, View};
use App\Models\Product;

class CartController extends Controller
{
    //Show the cart page with items
    public function show(): View
    {
        $cartItems = Session::get('cart');
        return View::render()->blade('client.cart.show', compact('cartItems'));
    }
    //Add item to cart
    public function addItem()
    {
        $request = Request::get('post');
        $id = $request->id;
        $quantity = $request->quantity;
        // If item already exists in cart, show message
        if (isset($_SESSION['cart'][$id])) {
            Session::add('invalids', ['This prooduct already exists on cart! To change it open the cart.']);
            exit("1");
        } else {
            // Add item to cart session
            $_SESSION['cart'][$id] = ['id' => $id, 'quantity' => $quantity];
            Session::add('message', 'Product added to the cart successfully!');
            exit("2");
        }
    }
    //Increase quantity
    public function incrementQty()
    {
        $id = Request::get('post')->id;
        $product = Product::query()->where('id', $id)->first();
        if ($product['quantity'] <= $_SESSION['cart'][$id]['quantity']) {
            exit();
        }
        $_SESSION['cart'][$id]['quantity']++;
        return true;
    }
    //Decrease quantity
    public function decrementQty(): bool
    {
        $id = Request::get('post')->id;
        if ($_SESSION['cart'][$id]['quantity'] <= 1) {
            unset($_SESSION['cart'][$id]);
            return true;
        }
        $_SESSION['cart'][$id]['quantity']--;
        return true;
    }
    // Get all cart items
    public function getCartItems()
    {
        return Session::get('cart');
    }
    //Remove a single item from cart
    public function removeItem(): void
    {
        $id = Request::get('post')->id;
        unset($_SESSION['cart'][$id]);
    }
    //Clear all items from cart
    public function removeAll(): void
    {
        Session::remove('cart');
        Session::add('cart', []);
    }
}
