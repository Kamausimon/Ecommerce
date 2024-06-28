<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategories extends Model
{
    use HasFactory;

    protected $table = 'product_subcategories';

    public function category()
    { //belongs to a category
        return $this->belongsTo('App\Models\ProductCategory', 'product_category');
    }
}
