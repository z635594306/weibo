<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});


Route::get('/reg', 'RegController@index');
Route::post('/reg', 'RegController@doreg');
Route::get('/active/token={token}&id={id}','ActiveController@active');


