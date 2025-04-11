<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use voku\helper\Paginator;

// Display a paginated list of all orders for the admin dashboard.
class OrderController extends Controller
{
    function __construct()
    {
        Role::handle();
    }

    public function index(): \App\Core\View
    {
        ['items' => $orders, 'links' => $links] = paginateData(Order::class, 8);

        return View::render()->blade('admin.orders.index', compact('orders', 'links'));
    }
}
