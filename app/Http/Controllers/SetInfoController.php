<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;
class SetInfoController extends Controller
{
    // 将 账户设置-个人信息 放到表单中
        public function index()
        {
            $id = session::get('userInfo')->id;
            // 获取数据
            $data = DB::table('user_info')->where('id',$id)->first();
            $pwd = DB::table('user_login')->where('id',$data->login_id)->value('password');
            
            return view("home.centerset", ['vo'=>$data]);
        }

        public function update(Request $request)
        {
            $id = session::get('userInfo')->id;
            /* 将 账户设置-个人信息 放到数据库 */
            // 获得表单数据
            $data = $request->only('nickname', 'sex', 'age', 'intro');
            if ($data['age'] < 0 || $data['age'] >150 ) {
                return "输入的年龄不合法,请重新输入";
            }
            // 执行修改
            $info = DB::table('user_info')->where('id', $id)->update($data);
            if ($info > 0) {
                // return "修改成功";
                return redirect()->action('SetInfoController@index');
            }else{
                return "修改失败";
                // return redirect()->action('Home/CenterController@update');
            }
        }

        public function pwdupdate(Request $request)
        {
            $id = session::get('userInfo')->id;
            // 获得user_login中的password值
            $data_pwd = DB::table('user_info')->where('id',$id)->first();
            $pwd['password'] = DB::table('user_login')->where('id',$data_pwd->login_id)->value('password');

            // 对密码进行判断
            $data = $request->only('pwd1', 'pwd2', 'pwd3');
            $data['pwd1'] = md5($data['pwd1']);
            if ($pwd['password'] !== $data['pwd1']) {
                return "输入的原密码不正确,请重新输入";
            }

            if (!preg_match_all("/^\w{6,}$/", $data['pwd2']) && !preg_match_all("/^\w{6,}$/", $data['pwd3'])) {
                return "密码至少为6位数!";
            }
            if ($data['pwd2'] !== $data['pwd3']) {
                return "俩次输入的新密码不匹配,请重新输入";
            }else{
                $pwd['password'] = md5($data['pwd2']);
                unset($data['pwd2']);
                unset($data['pwd3']);
            }

            // 执行修改
            $id = $data_pwd->login_id;
            $info = DB::table('user_login')->where('id',$id)->update($pwd);
            if ($info > 0) {
                return "修改成功";
            }else{
                return "修改失败";
            }
        }

    public function face()
    {
        return 123;
    }
}
