<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable=['name','phone','delivery_price'];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}
