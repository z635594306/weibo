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
//生成验证码
    Route::get('/captcha/{tmp}', 'CaptchaController@captcha');

//注册相关
    Route::get('/reg', 'RegController@index');
    Route::post('/reg/doreg', 'RegController@doreg');
    //邮箱激活
    Route::get('/active/token={token}&id={id}','ActiveController@active');
//注册相关

//登陆
    Route::post('/login', 'LoginController@login');




