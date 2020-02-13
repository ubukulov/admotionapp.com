<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Partner;

class AuthController extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registration(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        if ($data['user_type'] == 1) {
            $user = User::create($data);
            Auth::login($user);
            if (Auth::guard('partner')->check()) {
                Auth::guard('partner')->logout();
            }
            return redirect()->route('user.cabinet');
        } else {
            $partner = Partner::create($data);
            Auth::guard('partner')->login($partner);
            if (Auth::check()) {
                Auth::logout();
            }
            return redirect()->route('partner.cabinet');
        }
    }

    public function authenticate(Request $request)
    {
        $data = $request->all();
        if ($data['user_type'] == 1) {
            if (Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
                if (Auth::guard('partner')->check()) {
                    Auth::guard('partner')->logout();
                }
                return redirect()->route('user.cabinet');
            }
        } else {
            if (Auth::guard('partner')->attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
                if (Auth::check()) {
                    Auth::logout();
                }
                return redirect()->route('partner.cabinet');
            }
        }
    }

    public function username()
    {
        return 'phone';
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('partner')->logout();
        return redirect()->route('home');
    }
}
