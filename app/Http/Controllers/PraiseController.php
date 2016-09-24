<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;

class PraiseController extends Controller
{
    /*
    *   function    添加点赞
    *
    *   return      状态
    **/
    public function AddPraise(Request $request)
    {
        $weibo_id = $request->input('weibo_id');
        $user_id = $request->input('user_id');

        $data = DB::table('praise')
            ->where(['weibo_id'=>$weibo_id, 'user_id'=>$user_id])
            ->count();

        if (!$data) {
            DB::table('praise')->insert(['user_id' => $user_id, 'weibo_id' => $weibo_id]);
            DB::table('weibo')->where('id', $weibo_id)->increment('praise');
            $res = 1;
        }else{
            $res = 0;
        }
            
        return $res;
    }


    /*
    *   function    删除点赞
    *
    *   return      状态
    **/
    public function DelPraise(Request $request)
    {
        $weibo_id = $request->input('weibo_id');
        $user_id = $request->input('user_id');

        $res = DB::table('praise')
            ->where(['weibo_id'=>$weibo_id, 'user_id'=>$user_id])
            ->delete();
        
        if ($res) {
            DB::table('weibo')->where('id', $weibo_id)->decrement('praise');
        }
        return $res;
    }


    public function show()
    {
        $user_id = session::get('userInfo')->id;
        $weibos = DB::table('praise')
            ->join('weibo', 'weibo.id', '=', 'praise.weibo_id')
            ->join('user_info', 'weibo.user_id', '=', 'user_info.id')
            ->select('weibo.*', 'praise.user_id', 'user_info.id as uid', 'user_info.nickname', 'user_info.face50', 'user_info.face100')
            ->where('praise.user_id', $user_id)
            ->get();
        
        foreach ($weibos as $k => $v) {
            $time = $weibos[$k]->time;
            if (date('Yjn') == date('Yjn',$time)) {
                $weibos[$k]->time = ' 今天 '.date(' H:i ', $weibos[$k]->time);
            }elseif(date('Y') == date('Y',$weibos[$k]->time)){
                $weibos[$k]->time = date(' n月j日 H:i ', $weibos[$k]->time);
            }else{
                $weibos[$k]->time = date(' Y年n月j日 ', $weibos[$k]->time);
            }
        }

        return $weibos;
    }
}
