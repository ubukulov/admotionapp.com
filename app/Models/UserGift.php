<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGift extends Model
{
    protected $table = 'user_gifts';

    protected $fillable = [
        'gift_id', 'user_id', 'qty'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function gift()
    {
        return $this->hasOne('App\Models\Gift', 'id', 'gift_id');
    }
}
