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
        return $this->hasMany('App\Models\Gift', 'partner_id')->orderBy('id', 'DESC');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock', 'partner_id')->orderBy('id', 'DESC');
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
            ->select(DB::raw('users.first_name, users.email, users.phone, gifts.title as gift_title, payments.sum, payments.status, payments.updated_at, payments.id'))
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->join('gifts', 'gifts.id', '=', 'payments.gift_id')
            ->orderBy('payments.id', 'DESC')
            ->get();
        return $orders;
    }
}
