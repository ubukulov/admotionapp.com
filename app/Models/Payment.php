<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'partner_id', 'sum', 'p_id', 'p_salt', 'p_sig'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
