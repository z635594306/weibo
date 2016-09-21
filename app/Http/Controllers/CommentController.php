<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;

class CommentController extends Controller
{
    /*
    *   function    根据微博ID获取微博评论
    *
    *   return      获取到的资源
    *
    */
    public function get(Request $request)
    {
        $weibo_id = $request->input('wbId');

        $data = DB::table('weibo_comment')
            ->where('weibo_id', $weibo_id)
            ->join('user_info', 'user_info.id', '=', 'weibo_comment.user_id')
            ->select('weibo_comment.*', 'user_info.nickname')
            ->orderBy('time', 'desc')
            ->skip(0)->take(10)
            ->get();

        return $data;
    }


    /*
    *
    *   function    写入评论
    *
    *   return      成功:返回插入的数据
    *               失败:返回结果提示
    */
    public function set(Request $request)
    {
        $weibo_id = $request->input('weibo_id');
        $user_id = $request->input('user_id');
        $comment = $request->input('comment');

        $id = DB::table('weibo_comment')
            ->insertGetId(
                ['content' => $comment, 
                'time' => time(),
                'weibo_id' => $weibo_id, 
                'user_id' => $user_id]
            );

        if ($id > 0) {
            
            DB::table('weibo')->where('id',$weibo_id)->increment('comment');

            $data = DB::table('weibo_comment')
                ->where('weibo_id', $weibo_id)
                ->join('user_info', 'user_info.id', '=', 'weibo_comment.user_id')
                ->select('weibo_comment.*', 'user_info.nickname')
                ->orderBy('time', 'desc')
                ->skip(0)->take(1)
                ->get();

            return $data;

        }else{

            return null;
        }
        

    }



}