<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'partner_id', 'sum', 'p_id', 'p_salt', 'p_sig', 'status', 'gift_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function partner()
    {
        return $this->hasOne('App\Models\Partner', 'id', 'partner_id');
    }

    public function gift()
    {
        return $this->hasOne('App\Models\Gift', 'id', 'gift_id');
    }
}
