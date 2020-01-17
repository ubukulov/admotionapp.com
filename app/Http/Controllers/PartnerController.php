<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Partner;
use Illuminate\Http\Request;
use Auth;

class PartnerController extends BaseController
{
    public function login()
    {
        return view('partner.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::guard('partner')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Auth::check()) {
                Auth::logout();
            }
            return redirect()->route('partner.cabinet');
        }
    }

    public function register()
    {
        return view('partner.register');
    }

    public function registration(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        $user = Partner::create($data);
        Auth::guard('partner')->login($user);
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('partner.cabinet');
    }

    public function cabinet()
    {
        $partner = Auth::guard('partner')->user();
        return view('partner.cabinet', compact('partner'));
    }

    protected function guard()
    {
        return Auth::guard('partner');
    }

    protected function username()
    {
        return 'email';
    }

    public function updateProfile(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        if ($partner) {
            $partner->update($request->all());
            return redirect()->back();
        }
    }

    public function changeImage(Request $request)
    {
        $partner = Auth::guard('partner')->user();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $img = \Image::make($file->getPathname());
            $hash_name = md5($file->getClientOriginalName());
            $file_name = $partner->id."_".$hash_name.'.jpg';
            $save_path = base_path('public/uploads/partners/');
            $img->save($save_path.$file_name);
            $partner->image = $file_name;
            $partner->save();
            return redirect()->back();
        }
    }

    public function createGift()
    {
        return view('partner.create_gift');
    }

    public function storeGift(Request $request)
    {
        $partner = Auth::guard('partner')->user();
        if ($request->hasFile('file')) {
            $data = $request->except('file');
            $file = $request->file('file');
            $img = \Image::make($file->getPathname());
            $hash_name = md5($file->getClientOriginalName());
            $file_name = $partner->id."_".$hash_name.'.jpg';
            $save_path = base_path('public/uploads/gifts/');
            $img->resize(150, 150)->save($save_path.$file_name);
            $data['partner_id'] = $partner->id;
            $data['image'] = $file_name;
            Gift::create($data);
            return redirect()->route('partner.cabinet');
        }
    }
}
