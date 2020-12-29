<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_sub extends Model
{
    protected $fillable=['id','sub_id','name','address','phone','date','notes'];

    public function monthly_sub(){
        return $this->hasMany('App\Models\Monthly_sub');
    }
}
