<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_type extends Model
{
    use HasFactory;

    protected $table = 'admin_type';

    public function admin_user()
    { //has alot of admin users registered to it

        return $this->hasMany('App\Models\AdminUser', 'type_id');
    }
}
