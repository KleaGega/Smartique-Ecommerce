<?php

namespace App\Controllers;

use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Models\User;
use Exception;
//Handles user authentication: registration, login, logout.
class AuthController extends Controller
{
    public function __construct()
    {
		!(is_logged_in()) ?: redirect('/');
    }

    public function register(): View
    {
        return View::render()->blade('auth.register');
    }

    /**
     * @throws Exception
     */
    public function registerPost(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);
        // Validate registration fields
        RequestValidation::validate($request, [
            'fullname' => ['required' => true],
            'email' => ['required' => true, 'unique' => 'users', 'email' => true],
            'username' => ['required' => true, 'unique' => 'users', 'min' => 5],
            'password' => ['required' => true, 'min' => 6],
            'address' => ['required' => true],
            'city' => ['required' => true],
            'phone'=>['required' => true],
            'postal_code' => ['required' => true]
        ]);
        // Create new user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'password' => sha1($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'phone'=> $request->phone,
            'postal_code'=> $request->postal_code,
            'role' => 'user',
        ]);

        $user = User::where('username', $request->username)->first();
        Session::add('message', 'You are successfully registered, now you can login!');
        redirect('/login');
    }
    //Show the login form.
    public function login(): View
    {
        return View::render()->blade('auth.login');
    }

    /**
     * @throws Exception
     */
    //Handle user login.
    public function loginPost(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'username' => ['required' => true],
            'password' => ['required' => true, 'min' => 6]
        ]);

        $userQuery = User::query()->where('username', $request->username);

        if (!$userQuery->exists()) {
            Session::add('invalids', ['User not found']);
            redirect('/login');
            return;
        }

        $user = $userQuery->first();
        // Compare hashed password
        if (sha1($request->password) !== $user->password) {
            Session::add('invalids', ['Password is invalid']);
            redirect('/login');
            return;
        }

        Session::add('user_id', $user->id);
        Session::add('user_name', $user->fullname);
        if($user->role == 'admin') {
            redirect('/admin');
        } else {
            redirect('/profile');
        }
    }

    //Log the user out and destroy session.
    public function logout(): void
    {
        if (is_logged_in()) {
            Session::remove('user_id');
            Session::remove('user_name');

            if (Session::has('cart')) {
                session_destroy();
            }
        }
        redirect('/login');
    }
}
