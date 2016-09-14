<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Mail;

class RegController extends Controller
{
    public function index(){
        return view('home.reg');
    }

    public function doReg(Request $request)
    {

        $email = $request->input('email');
        $pwd = md5($request->input('pwd'));

        //将注册信息插入数据库并取回自增id
        $login_id = db::table('user_login')->insertGetId(

            ['email' => $email, 'password' => $pwd, 'registime' => time()]

        );
        //将注册信息插入邮件激活表等待激活
        $temp_id = db::table('temp_email')->insertGetId(

            ['login_id' => $login_id, 'test' => $pwd, 'overtime' => time() + 3600 * 24]

        );

        //向用户发送激活邮件
        Mail::send('mail.mail', ['token' => $pwd, 'user' => $email, 'id' => $temp_id], function ($message) use ($email) {

            $message->to($email, '尊敬的用户您好')->subject('这是兄弟连微博激活邮件,请您在24小时内处理');

        });

        return view('mail.go',['user' => $email]);

    }
}
