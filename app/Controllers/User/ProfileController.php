<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Middlewares\Auth;
use Exception;
use App\Models\{Order, User};

//Handles user profile functionalities like viewing, editing, updating info and password, and viewing orders.
class ProfileController extends Controller
{
    public function __construct()
    {
        Auth::check();
    }

    public function index(): View
    {
        $user = get_logged_in_user();
        $ordersCount = count(Order::query()->where('user_id', $user->id)->get());
        return View::render()->blade('user.profile.index', compact('user', 'ordersCount'));
    }

    public function edit($id): View
    {
        $user = get_logged_in_user();
        return View::render()->blade('user.profile.edit', compact('user'));
    }

    /**
     * @throws Exception
     */
    public function update($id): void
    {
        $request = Request::get('post');
        CSRFToken::verify($request->csrf);

        RequestValidation::validate($request, [
            'username' => ['required' => true],
            'fullname' => ['required' => true],
            'address' => ['required' => true],
            'city' => ['required' => true],
            'phone'=> ['required' => true],
            'postal_code'=> ['required' => true],
        ]);

        $user = User::query()->whereId($id)->first();

        $user->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,

        ]);

        Session::add('message', 'profile updated successfully');
        redirect('/profile');
    }

    public function editPassword($id): View
    {
        $user = User::query()->whereId($id)->first();

        return View::render()->blade('user.profile.password', compact('user'));
    }

    /**
     * @throws Exception
     */
    public function updatePassword($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'oldPassword' => ['required' => true, 'minLength' => 4],
            'newPassword' => ['required' => true, 'minLength' => 4],
        ]);

        $user = User::query()->where('id', $id)->first();

        if (sha1($request->oldPassword) !== $user->password) {
            Session::add('invalids', ['old password incorrect']);
            redirect("/profile/{$id['id']}/edit/password");
            return;
        }

        $user->update([
            'password' => sha1($request->newPassword)
        ]);

        Session::add('message', 'password updated');
        redirect("/profile");
    }

    public function orders($userid): View
    {
        $orders = Order::query()->where('user_id', $userid)->get();
        $user = get_logged_in_user();
        return View::render()->blade('user.orders.index', compact('orders', 'user'));
    }
}
