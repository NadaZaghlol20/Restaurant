<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['client_id','restaurant_id','delivery_id','price','name','phone','address','food','restaurant'];

    public function restaurants(){
        return $this->hasMany('App\Models\Restaurant');
    }

    public function clients(){
        return $this->hasMany('App\Models\Client');
    }

    public function delivery(){
        return $this->belongsTo('App\Models\Delivery');
    }

    // protected $casts = [
    //     'food' => 'array',
    // ];
}
