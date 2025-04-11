<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Product;
use App\Models\Order;

// Display the admin dashboard with recent products, total order count, and orders grouped by city.
class DashboardController extends Controller
{
    public function __construct()
    {
        Role::handle();
    }

    public function index(): View
    {
        $recentProducts = Product::orderBy('created_at', 'desc')->limit(5)->get();
        $ordersCount = Order::count();
        $ordersByCity = Order::selectRaw('users.city, count(orders.id) as total')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.city')
            ->orderBy('total', 'desc')
            ->get();
        return View::render()->blade('admin.dashboard', compact('recentProducts', 'ordersCount','ordersByCity'));
    }
}
