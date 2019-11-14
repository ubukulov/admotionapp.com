<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends BaseController
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Auth::guard('partner')->check()) {
                Auth::guard('partner')->logout();
            }
            return redirect()->route('user.cabinet');
        }
    }

    public function register()
    {
        return view('user.register');
    }

    public function registration(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $user = User::create($data);
        Auth::login($user);
        if (Auth::guard('partner')->check()) {
            Auth::guard('partner')->logout();
        }
        return redirect()->route('user.cabinet');
    }

    public function cabinet()
    {
        return view('user.cabinet');
    }
}
