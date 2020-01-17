<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Partner extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'title', 'phone', 'address', 'image', 'description', 'discount'
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

    public function historyOrders()
    {
        $orders = Payment::where(['payments.partner_id' => $this->id])
            ->select(DB::raw('users.name, users.email, users.phone, gifts.title as gift_title, user_gifts.qty, payments.sum, payments.status, payments.updated_at, payments.id'))
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->join('user_gifts', 'user_gifts.user_id', '=', 'users.id')
            ->join('gifts', 'gifts.id', '=', 'user_gifts.gift_id')
            ->where(['gifts.partner_id' => $this->id])
            ->groupBy('payments.id');
        return $orders;
    }
}
