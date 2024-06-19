<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    public function payment()
    { //orders has one payment
        return $this->hasOne('App\Models\Payment', 'payment_id');
    }

    public function user()
    {
        //order belongs to a user
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function OrderDetail()
    {
        //Order has alot of Order details

        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }
}
