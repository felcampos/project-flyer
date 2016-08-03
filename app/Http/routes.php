<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('pages.home');
});

Route::resource('flyers', 'FlyersController');

//sobrepor o @show do Route::resource pq ele espera apenas o id.
Route::get('{zip}/{street}', 'FlyersController@show');

Route::post('{zip}/{street}/photos', 'FlyersController@addPhoto');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::delete('photos/{photo}', 'PhotosController@destroy');
