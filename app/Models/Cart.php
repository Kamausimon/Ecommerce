<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        //a cart belongs to a single user
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cartItem()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id');
    }
}
