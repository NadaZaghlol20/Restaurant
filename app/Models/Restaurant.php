<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable=['name','address','phone'];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }
}
