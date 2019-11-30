<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partner extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'title', 'phone', 'address', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gifts()
    {
        return $this->hasMany('App\Models\Gift', 'partner_id');
    }

    public function img()
    {
        return asset('uploads/partners/'.$this->image);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_partners', 'partner_id', 'category_id');
    }
}
