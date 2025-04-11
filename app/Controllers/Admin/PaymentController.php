<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Payment;

// Controller for managing and displaying payment records in the admin dashboard.
class OrderController extends Controller
{
    protected int $count;

    function __construct()
    {
        Role::handle();

        $this->count = Payment::query()->count();
    }

    public function index(): View
    {
        ['items' => $payments, 'links' => $links] = paginateData(Payment::class, 8);

        return View::render()->blade('admin.payments.index', compact('payments', 'links'));
    }
}
