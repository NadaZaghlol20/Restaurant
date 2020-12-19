<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function monthly_subscription(){
        return view('subscriptions.monthly.monthly_subscription');
    }

    public function food_subscription(){
        // return view('subscriptions.food.food_subscription');
    }
}
