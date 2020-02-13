<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\BaseController;
use App\Models\Stock;
use Illuminate\Http\Request;
use Auth;

class StockController extends BaseController
{
    protected $imagePath = 'uploads/stocks/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Auth::guard('partner')->user()->stocks;
        return view('partner.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partner.stock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $partner = Auth::guard('partner')->user();
        $stock = Stock::create([
            'partner_id' => $partner->id, 'category_id' => $data['category_id'], 'stock_type' => $data['stock_type'], 'title' => $data['title'], 'short_description' => $data['short_description'],
            'full_description' => $data['full_description'], 'start' => date('Y-m-d H:i:s', strtotime($data['start'])), 'end' => date('Y-m-d H:i:s', strtotime($data['end'])),
            'phone' => $data['phone'], 'active' => $data['active']
        ]);
        if ($stock) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $img = \Image::make($file->getPathname());
                $hash_name = md5($file->getClientOriginalName());
                $file_name = $stock->id."_".$hash_name.'.jpg';

                $save_path = base_path('public/'.$this->imagePath);
                $img->save($save_path.$file_name);

                $stock->image = $file_name;
                $stock->save();
            }

            return response('Акция успешно создан.');
        } else {
            return response('Ошибка при создание акции. Попробуйте позже', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
