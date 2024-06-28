<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public function user()
    {
        // a payment belongs to a user
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function order()
    {
        //each order is associated with one payment
        return $this->belongsTo('App\Models\Order', 'payment_id');
    }
}
