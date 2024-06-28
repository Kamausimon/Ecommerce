<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'discount_product');
    }
}
