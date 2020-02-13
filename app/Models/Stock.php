<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'partner_id', 'category_id', 'stock_type', 'title', 'image', 'short_description', 'full_description', 'start', 'end', 'phone', 'active', 'created_at', 'updated_at'
    ];

    public function img()
    {
        return asset('uploads/stocks/'.$this->image);
    }

    public function partner()
    {
        return $this->hasOne('App\Models\Partner', 'id', 'partner_id');
    }

    public function gifts()
    {
        return $this->hasMany('App\Models\Gift', 'stock_id')->orderBy('id', 'DESC');
    }
}
