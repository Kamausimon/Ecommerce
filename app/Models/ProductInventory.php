<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductInventory extends Model
{
    use HasFactory;

    protected $table = 'product_inventory';

    public function inventory()
    {
        return $this->hasMany('App\Models\Product', 'inventory_id');
    }
}
