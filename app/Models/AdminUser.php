<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_user extends Model
{
    use HasFactory;

    protected $table = 'admin_user';

    public function admin_type()
    {
        //belongs to admin type
        return $this->belongsTo('App\Models\AdminType', 'type_id');
    }
}
