<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class ActiveController extends Controller
{
    /*
    *function: 用户账号激活
    *$id:      激活id
    *$token    激活码
    */
    public function active($token, $id)
    {
        //取数据库数据,判断数据是否存在
        if (!$resource = db::table('temp_email')->where('id',$id)->first()) {
            return view('mail.active',['color' => 'red',
                        'message' => '激活失败,账户已经激活或链接无效',
                        'url' => 'reg',
                        'title' => '重新注册'
                        ]);
        } 

        //判断链接是否超时
        if (time() > $resource->overtime) {
            return view('mail.active',['color' => 'red',
                        'message' => '激活失败,链接已过期',
                        'url' => 'reg',
                        'title' => '重新注册'
                        ]);
        }

        //判断token值
        if ($token != $resource->test) {
            return view('mail.active',['color' => 'red',
                        'message' => '激活失败,链接无效',
                        'url' => ' ',
                        'title' => '回到主页'
                        ]);
        }

        DB::transaction(function () use($resource) {
            //修改用户激活状态
            DB::table('user_login')
                ->where('id',$resource->login_id)
                ->update(['active' => 1]);
            //删除激活数据
            DB::table('temp_email')
                ->where('id', $resource->id)
                ->delete();
            //创建用户基本信息
            $id = DB::table('user_info')->insertGetId(
                    ['nickname' => 'XDL_'.time(),
                     'face50' => 'face50.jpg',
                     'face100' => 'face100.jpg',
                     'login_id' => $resource->login_id
                    ]
                );

            DB::table('user_vip')->insert(['user_id'=>$id, 'creattime'=>0, 'endtime'=>0]);
        });

        //激活成功
        return view('mail.active',['color' => '#03D03D',
                        'message' => '激活成功,兄弟连微博欢迎您',
                        'url' => 'reg',
                        'title' => '立即登录'
                        ]);
    }

}
