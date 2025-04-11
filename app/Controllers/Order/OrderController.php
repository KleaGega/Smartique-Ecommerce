<?php
namespace App\Controllers\Order;

use App\Controllers\Controller;
use App\Middlewares\Auth;
use App\Core\{Cart, Session, Request};
use Exception;
use App\Models\{Order, OrderItem, Payment, Product, User};

// Controller for handling user order actions like placing, cancelling, and marking orders as paid.

class OrderController extends Controller
{
    public function pay()
    {
        Auth::check();
        $this->checkCartIsNotEmpty();

        $user = User::query()->where('id', Session::get('user_id'))->first();

        try {
            $cart = Session::get('cart');
            $ref_code = uniqid('ORDER-', true);

            $order = Order::query()->create([
                'user_id' => $user->id,
                'total_price' => Cart::getTotalAmount(),
                'status' => 'pending',
                'ref_code' => $ref_code,
            ]);

            foreach ($cart as $item) {
                $product = Product::query()->where('id', $item['id'])->first();

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $product->price * $item['quantity'],
                ]);
            }

            Payment::query()->create([
                'order_id' => $order->id,
                'ref_id' => $ref_code,
                'status' => 'pending',
            ]);

            Session::remove('cart');
            
            Session::add('payment', 'Your order has been placed successfully. Please pay in cash upon delivery.');
            
            redirect('/cart');
            
        } catch (Exception $e) {
            die($e->getMessage() . ' : line' . $e->getLine());
        }
    }

    protected function checkCartIsNotEmpty(): void
    {
        if (is_null(Session::get('cart'))) {
            redirect('/');
        }
    }
    
    public function markAsPaid($orderId)
    {
        $this->checkIsAdmin();
        
        try {
            $order = Order::query()->where('id', $orderId)->first();
            
            if (!$order) {
                Session::add('error', 'Order not found');
                redirect('/admin/orders');
            }
            $order->update(['status' => 'paid']);
            Payment::query()->where('order_id', $orderId)->update(['status' => 'paid']);
            Session::add('success', 'Order #' . $orderId . ' has been marked as paid');
            redirect('/admin/orders');
            
        } catch (Exception $e) {
            Session::add('error', $e->getMessage());
            redirect('/admin/orders');
        }
    }
    
    protected function checkIsAdmin(): void
    {
        if (!(Session::has('SESSION_USER_ROLE') && Session::get('SESSION_USER_ROLE') === 'admin')) {
            Session::add('error', 'You are not authorized to perform this action');
            redirect('/');
        }
    }
    
    public function cancelOrder($orderId)
    {
        Auth::check();
        
        try {
            $order = Order::query()->where('id', $orderId)->first();
            
            if (!$order) {
                Session::add('error', 'Order not found');
                redirect('/orders');
            }
            
            $userId = Session::get('user_id');
            $isAdmin = Session::has('SESSION_USER_ROLE') && Session::get('SESSION_USER_ROLE') === 'admin';
            
            if ($order->user_id != $userId && !$isAdmin) {
                Session::add('error', 'You are not authorized to cancel this order');
                redirect('/orders');
            }
            
            if ($order->status !== 'pending' && $order->status !== 'unpaid') {
                Session::add('error', 'This order cannot be cancelled');
                redirect('/orders');
            }

            $order->update(['status' => 'cancelled']);
            Payment::query()->where('order_id', $orderId)->update(['status' => 'cancelled']);
            Session::add('success', 'Order #' . $orderId . ' has been cancelled');
            redirect('/orders');
        } catch (Exception $e) {
            Session::add('error', $e->getMessage());
            redirect('/orders');
        }
    }
}