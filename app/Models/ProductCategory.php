<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category'; //specify the table name
    protected $fillable = ['name', 'description']; //specify the columns that can be filled [name, description

    public function product()
    {  //the category has many products
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    public function parent()
    {
        //the category has many subcategories
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id');
    }

    public function subcategories()
    {
        //the category has many subcategories
        return $this->hasMany('App\Models\ProductCategory', 'parent_id');
    }
}
