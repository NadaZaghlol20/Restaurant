<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=['restaurant_id','food','price'];

    public function restaurants(){
        return $this->hasMany('App\Models\Restaurant');
    }
}
