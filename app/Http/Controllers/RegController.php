<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Mail;

use Session;

class RegController extends Controller
{
    public function index(){
        return view('home.reg');
    }

    public function doReg(Request $request)
    {

        $email = $request->input('email');
        $pwd = md5($request->input('pwd'));
        $pwd_code = $request->input('pwd_code');
        $code = $request->input('code');

        //判断验证码是否正确
        if ($code != Session::get('code')) {
            $message = array('error' => '1', 'message' => '验证码错误');
            return $message;
        }

        if (empty($email)) {
            $message = array('error' => '2', 'message' => '账号不能为空');
            return $message;
        }

        if ($pwd_code > 0) {
            $message = array('error' => '3', 'message' => '密码格式不正确');
            return $message;
        }

        //判断账号是否存在
        $count = db::table('user_login')->where('email','=',$email)->count();
        if ($count > 0) {
            $message = array('error' => '4', 'message' => '此邮箱已被注册');
            return $message;
        }

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

        $message = array('error' => '0', 'message' => '注册成功,请前往您的邮箱进行账户激活');
        return $message;
        // return view('mail.go',['user' => $email]);

    }
}
