<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//引用对应的命名空间 使用验证码程序
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class LoginController extends Controller
{
    // 1 登录表单
    public function login()
    {
        return view('admins.login.login');
    }

    // 2 执行登录
    public function doLogin(Request $request)
    {
        // dd($request);
        // return "234";
        //1 验证验证码
        $mycode = Session::get("code");
        // dd($mycode);
        // dd($request->input('code'));
        if($request->input('code')!==$mycode){
            //跳转方式1
            // Session::flash("msg","验证码错误");
            // return redirect("admin/login");
            //跳转方式2 
            return back()->with("msg","验证码错误");
            // return "1";
        }

        //获得邮箱和密码信息
        $email = $request->input("email");
        $password= $request->input("password");
        // var_dump($email);
        // var_dump($password);
        //2 验证账号
        $ob = \DB::table("user_login")->where("email",$email)->first();
        // var_dump($ob);
        // exit();
        //验证邮箱是否存在
        if($ob){
            //验证密码是否正确
            if($ob->password == $password){
                //登录成功写入到session
                Session::set("email",$ob);
                // Session::put("username",$ob);
                return view("admins.index.index");
            }else{
                return back()->with("msg","用户或密码错误1");
            }
        }
        return back()->with("msg","用户或密码错误2");
    }

    // 执行退出
    public function logout()
    {
        //删除session值 
        session::forget("email");
        //跳转
        return redirect("admins/login");
    }

    // 验证码
    public function captcha($tmp)
    {
         //负责输出验证码程序
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
       
            //生成验证码图片的Builder对象，配置相应属性
            $builder = new CaptchaBuilder;
            // dd($builder);
            //可以设置图片宽高及字体
            $builder->build($width = 120, $height = 30, $font = null);
            //获取验证码的内容
            $phrase = $builder->getPhrase();
            // dd($phrase);//输出随机字符串的值 
            // echo $phrase;
            //把内容存入session
            Session::flash('mycode', $phrase);//通过静态方法的方式使用flash
            // session()->flash('mycode',$phrase);//使用对象和方法的方式使用flash方法

            //输出session的值 
            // echo "<hr>";
            // echo Session::get("mycode");
            // echo "<hr>";
            // exit();
            //生成图片
            header("Cache-Control: no-cache, must-revalidate");
            header('Content-Type: image/jpeg');
            $builder->output();
            // exit();
        
    }
}
