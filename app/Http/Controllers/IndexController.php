<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Auth;

class IndexController extends BaseController
{
    public function welcome()
    {
        return view('welcome', ['partners' => Partner::all()]);
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('partner')->logout();
        return redirect()->route('home');
    }

    public function partners()
    {
        return view('partners', ['partners' => Partner::all()]);
    }

    public function partner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('partner', compact('partner'));
    }
}
