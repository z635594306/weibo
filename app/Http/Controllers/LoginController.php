<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;
class LoginController extends Controller
{
    /*
    *functin : 执行登陆
    *return  : 验证结果
    *session : 用户信息
    */
    public function login(Request $request)
    {
        //获取请求信息
        $email = $request->input('email');
        $pwd = md5($request->input('pwd'));
        $code = $request->input('code');

        //检测验证码是否正确
        if ($code != Session::get('code')) {
            $message = array('error' => '1', 'message' => '验证码不正确');
            return $message;
        }

        //查询账号是否存在
        $count = db::table('user_login')->where('email','=',$email)->count();
        
        if ($count < 1) {
            $message = array('error' => '2', 'message' => '账号不存在');
            return $message;
        }

        //查询账号登陆信息
        $res = db::table('user_login')->where('email','=',$email)->first();
        //判断密码是否正确
        if ($res->password != $pwd) {
            $message = array('error' => '3', 'message' => '密码错误');
            return $message;
        }
        //判断账号是否被锁定
        if ($res->lock == 1) {
            $message = array('error' => '4', 'message' => '账户因违反规定已被禁用,请联系管理员');
            return $message;
        }

        //判断账号是否被激活
        if ($res->active == 0) {
            $message = array('error' => '5', 'message' => '账户未激活,请前往邮箱激活后再登陆');
            return $message;
        }
        //判断结束

        //写用户数据到session
        $user_info = db::table('user_info')->where('login_id','=',$res->id)->first();
        Session::set('userInfo',$user_info);

        return $message['error'] = 0;
        
    }
}
