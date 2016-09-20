<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use DB;

class WeiboController extends Controller
{
    /*
    *   function  发表微博
    *
    *   return    返回状态
    *
    *   $request  前端发博表单
    */
    public function published(Request $request)
    {
        $content = $request->input('weiboContent');

        //判断内容是否为空,为空返回异常
        if (empty($content)) {
            return array('error' => 1, 'message' => '微博内容不能为空');
        }

        //将微博内容写入数据表并返回自增ID
        $id = DB::table('weibo')->insertGetId(

            ['content' => $content, 'time' => time(), 'user_id' => session::get('userInfo')->id]

            );
        //判断自增ID是否大于0,大于说明发表成功,用户表微博数量+1
        if ($id > 0) {
            DB::table('user_info')->where('id',session::get('userInfo')->id)->increment('weibo');
        }

        //返回状态
        if ($id > 0) {
            return array('error' => 0, 'message' => '发表微博成功');
        }else{
            return array('error' => 2, 'message' => '发表微博失败');
        }
    }
}
