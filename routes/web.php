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
//主页
    Route::get('/', 'IndexController@index');
    Route::get('/page/{page?}', 'IndexController@index');
    Route::post('/published', 'WeiboController@published');
    Route::post('/delweibo', 'WeiboController@delWeibo');
//生成验证码
    Route::get('/captcha/{tmp}', 'CaptchaController@captcha');

//注册相关
    Route::get('/reg', 'RegController@index');
    Route::post('/reg/doreg', 'RegController@doreg');
//邮箱激活
    Route::get('/active/token={token}&id={id}','ActiveController@active');


//登陆
    Route::post('/login', 'LoginController@login');

//获取微博评论
    Route::post('/comment/get', 'CommentController@get');
    Route::post('/comment/set', 'CommentController@set');

//微博点赞
    Route::post('/praise/add', 'PraiseController@AddPraise');
    Route::post('/praise/del', 'PraiseController@DelPraise');
    Route::post('/praise', 'PraiseController@show');
//微博收藏
    Route::post('/keep/add', 'KeepController@Addkeep');
    Route::post('/keep/del', 'KeepController@Delkeep');
    Route::post('/keep', 'KeepController@show');

//关注与粉丝
    Route::post('/follow/add', 'FansController@AddFollow');
    Route::post('/follow/del', 'FansController@DelFollow');
    Route::post('/follow/look', 'FansController@LookFollow');
    Route::post('/fans/look', 'FansController@LookFans');


/*-----------------------------小模块------------------------------------------*/
//天气
    Route::get('/tianqi', function(){
        $json = file_get_contents('https://api.thinkpage.cn/v3/weather/now.json?key=yjfwsn87ggfmojel&location=ip&language=zh-Hans&unit=c');

        return $json;
    });
//左右广告
    Route::get('/guanggao', function(){
        $data = DB::table('advertising')
            ->where('lock', 0)
            ->inRandomOrder()
            ->take(2)
            ->get();

        return $data;
    });


/*----------------------------------------------------------------------------------*/
    /* 账号设置 */
    //显示账号设置页
    Route::get('/centerset', 'SetInfoController@index');

    // 修改个人账户信息
    Route::post("/centerset/update", 'SetInfoController@update');
    Route::post("/centerset/face", 'SetInfoController@face');

    //密码
    Route::post('/centerset/pwd', 'SetInfoController@pwdupdate');

    /* 个人主页 */
    Route::get('/center', 'ZoneController@index');


    /* 管理后台登录 */
    //1 不需要登录就能访问的 登录 执行登录 验证码

    //登录表单
    Route::get("/admins/login","Admins\LoginController@login");

    //执行登录
    Route::post("/admins/dologin","Admins\LoginController@doLogin");

    //验证码
    Route::get("/admins/captcha/{tmp}","Admins\LoginController@captcha");

    //添加表单
    Route::get("/admins/users/add","Admins\UsersController@create");


    //2 需要登录才能访问的页面 执行退出 \后台首页\后台学生页面
    Route::group(['prefix'=>'admins', 'middleware"=>"myauth'],function(){

        // 后台退出
        Route::get("/logout","Admins\LoginController@logout");

        // 后台首页
        Route::get("/index","Admins\IndexController@index");

        // 微博管理
        Route::get("/message","Admins\WeiboController@index");

        // 微博删除
        Route::get("/message/del/{id}","Admins\WeiboController@doDel");

        // 微博封印 解封
        Route::get("/message/edit/{id}/{lock}","Admins\WeiboController@edit");

        // 显示详情
        Route::get("/message/{id}","Admins\WeiboController@show");

        //用户权限
        Route::get("/powers","Admins\PowersController@powers");
        
        //修改权限
        Route::get("/powers/{id}/{lock}","Admins\PowersController@update");

        // 用户角色
        Route::resource('users', 'Admins\UsersController');

    });

/*----------------------------------------------------------------------------------*/

