<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'inventory_id',
        'discount_id',
        'sku',
        'image'
    ];


    public function category()
    {  //each product has one category
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
    }

    public function inventory()
    {
        //each product has one inventory
        return $this->belongsTo('App\Models\ProductInventory', 'inventory_id');
    }

    public  function discount()
    {
        return $this->belongsTo('App\Models\Discount', 'discount_id');
    }

    public  function discounts()
    {
        return $this->belongsToMany('App\Models\Discount', 'discount_product');
    }

    public function cartItem()
    {
        //each product is associated with many cart item
        return $this->hasMany('App\Models\CartItem', 'product_id');
    }

    public function OrderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'product_id');
    }
}
