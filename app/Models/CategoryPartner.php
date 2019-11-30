<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPartner extends Model
{
    protected $table = 'category_partners';

    protected $fillable = [
        'category_id', 'partner_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
