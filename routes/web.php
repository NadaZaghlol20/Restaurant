<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','WelcomeController@index')->name('welcome');

//Monthly subscription routes
Route::get('/monthly_sub','Monthly_subController@index');
Route::post('/monthly_sub_create','Monthly_subController@create');
Route::post('/monthly_sub_update','Monthly_subController@update')->name('update_monthly_sub');
Route::delete('/monthly_sub_delete/{id}','Monthly_subController@destroy');
Route::delete('monthly_sub/destroy', 'Monthly_subController@massDestroy')->name('monthly_subs.massDestroy');


//Food subscription routes
Route::get('/food_sub','Food_subController@index');
Route::post('/food_sub_create','Food_subController@create');
Route::post('/food_sub_update','Food_subController@update')->name('update_food_sub');
Route::delete('/food_sub_delete/{id}','Food_subController@destroy');
Route::delete('food_sub/destroy', 'Food_subController@massDestroy')->name('food_subs.massDestroy');


//Clients routes
Route::get('/clients','ClientsController@index');
Route::post('/clients_create','ClientsController@create');
Route::post('/clients_update','ClientsController@update')->name('update_client');
Route::delete('/clients_delete/{id}','ClientsController@destroy');
Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');


// delivery Routes
Route::get('/deliveries','DeliveriesController@index');
Route::post('/deliveries_create','DeliveriesController@create');
Route::post('/deliveries_update','DeliveriesController@update')->name('update_delivery');
Route::delete('/deliveries_delete/{id}','DeliveriesController@destroy');
Route::delete('deliveries/destroy', 'DeliveriesController@massDestroy')->name('deliveries.massDestroy');

//Restaurants
Route::get('/restaurants','RestaurantsController@index');
Route::post('/restaurants_create','RestaurantsController@create');
Route::post('/restaurants_update','RestaurantsController@update')->name('update_restaurant');
Route::delete('/restaurants_delete/{id}','RestaurantsController@destroy');
Route::delete('restaurants/destroy', 'RestaurantsController@massDestroy')->name('restaurants.massDestroy');

//Menus Routes
Route::get('/menus','MenusController@index');
Route::post('/menus_create','MenusController@create');
Route::post('/menus_update','MenusController@update')->name('update_menu');
Route::delete('/menus_delete/{id}','MenusController@destroy');
Route::delete('menus/destroy', 'MenusController@massDestroy')->name('menus.massDestroy');

//Orders Routes
Route::get('/orders','OrdersController@index');
Route::post('/orders_create','OrdersController@create');
Route::post('/orders_update','OrdersController@update')->name('update_order');
Route::delete('/orders_delete/{id}','OrdersController@destroy');
Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
