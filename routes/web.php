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

Route::resource('/monthly_subscription','WelcomeController');
Route::delete('monthly_subscription/destroy', 'WelcomeController@massDestroy')->name('monthly_subscription.massDestroy');

// Route::get('/food_subscription','SubscriptionController');
// Route::delete('food_subscription/destroy', 'SubscriptionController@massDestroy')->name('food_subscription.massDestroy');

//Clients
Route::get('/clients','ClientsController@index');
Route::post('/clients_create','ClientsController@create');
Route::post('/clients_update/{id}','ClientsController@update');
Route::delete('/clients_delete/{id}','ClientsController@destroy');
Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
