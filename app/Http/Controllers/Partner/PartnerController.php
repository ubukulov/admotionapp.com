<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\BaseController;
use App\Models\Gift;
use App\Models\Partner;
use App\Models\Stock;
use Illuminate\Http\Request;
use Auth;

class PartnerController extends BaseController
{
    public function cabinet()
    {
        $partner = Auth::guard('partner')->user();
        return view('partner.cabinet', compact('partner'));
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

    public function createGift($stock_id)
    {
        return view('partner.create_gift', compact('stock_id'));
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
            $data['image'] = $file_name;
            Gift::create($data);
            return redirect()->route('partner.cabinet');
        }
    }

    public function orders()
    {
        $orders = Auth::guard('partner')->user()->historyOrders();
        return view('partner.orders', compact('orders'));
    }

    public function gifts($stock_id)
    {
        $stock = Stock::findOrFail($stock_id);
        return view('partner.gifts', [
            'partner' => Auth::guard('partner')->user(),
            'stock' => $stock
        ]);
    }

    public function logout()
    {
        Auth::guard('partner')->logout();
        return redirect()->route('home');
    }
}
