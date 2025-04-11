<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

// Controller for managing users in the admin dashboard, including listing, editing, deleting, and user distribution by city.
class UserController extends Controller
{
    protected int $count;

    public function __construct()
    {
        $this->count = User::query()->count();
    }

    public function index(): View
    {
        ['items' => $users, 'links' => $links] = paginateData(User::class, 8);

        return View::render()->blade('admin.users.index', compact('users', 'links'));
    }

    public function edit($id): View
    {
        $user = User::query()->where('id', $id)->first();

        return View::render()->blade('admin.users.edit', compact('user'));
    }

    /**
     * @throws Exception
     */
    public function update($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'fullname' => ['required' => true],
            'username' => ['required' => true],
            'role' => ['required' => true],
        ]);

        $user = User::query()->where('id', $id)->first();

        $user->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        Session::add('message', 'User updated successfully');
        redirect('/admin/users');
    }

    public function delete($id): void
    {
        $user = User::query()->where('id', $id)->first();
        $user->delete();
        Session::add('message', 'User deleted');
        redirect('/admin/users');
    }

    public function distribution(): View
    {
        $usersByCity = User::selectRaw('city, count(*) as total')
                      ->groupBy('city')
                      ->orderBy('total', 'desc')
                      ->get();
        
        return View::render()->blade('admin.users.distribution', compact('usersByCity'));
    }
}
