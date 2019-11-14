<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'partner_id', 'title', 'description', 'image', 'from', 'to', 'quantity', 'active'
    ];

    public function img()
    {
        return asset('uploads/gifts/'.$this->image);
    }

    public function condition()
    {
        if (empty($this->from) && !empty($this->to)) {
            return 'до '.$this->to.' тг.';
        }

        if (!empty($this->from) && empty($this->to)) {
            return 'от '.$this->from.' тг.';
        }

        if (!empty($this->from) && !empty($this->to)) {
            return 'от '.$this->from.' тг.'.' до '.$this->to.' тг.';
        }

        if (empty($this->from) && empty($this->to)) {
            return 'условия не указано';
        }
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }
}
