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
            $weibo = DB::table('weibo')
                ->where('id', $id)
                ->skip(0)->take(1)
                ->get();

            $userInfo = DB::table('user_info')
                ->where('id', session::get('userInfo')->id)
                ->skip(0)->take(1)
                ->get();

            //处理时间

                $time = $weibo[0]->time;
                if (date('Yjn') == date('Yjn',$time)) {
                    $weibo[0]->time = ' 今天 '.date(' H:i ', $weibo[0]->time);
                }elseif(date('Y') == date('Y',$weibo[0]->time)){
                    $weibo[0]->time = date(' n月j日 H:i ', $weibo[0]->time);
                }else{
                    $weibo[0]->time = date(' Y年n月j日 ', $weibo[0]->time);
                }

            return array('error' => 0, 'message' => '发表微博成功', $weibo[0], $userInfo[0]);
        }else{
            return array('error' => 2, 'message' => '发表微博失败');
        }
    }

    //删除微博
    public function delWeibo(Request $request)
    {
        $id = $request->input('weibo_id');
        DB::table('praise')->where(['weibo_id'=>$id, 'user_id'=>session::get('userInfo')->id])->delete();
        DB::table('keep')->where(['weibo_id'=>$id, 'user_id'=>session::get('userInfo')->id])->delete();
        DB::table('weibo_comment')->where('weibo_id', $id)->delete();
        $src = DB::table('weibo')->where('id', $id)->delete();

        if ($src) {
            
            DB::table('user_info')->where('id', session::get('userInfo')->id)->decrement('weibo');
        }
        sleep(1);
        return $src;
    }

}
