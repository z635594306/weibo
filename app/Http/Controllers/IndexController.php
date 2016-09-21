<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;

class IndexController extends Controller
{   
    /*
    *   function 构建主页内容
    *   
    *   return   返回微博信息
    *
    */
    public function index()
    {
        //判断用户session是否为空,不为空显示用户及粉丝微博
        $userInfo = session::get('userInfo');
        if (!empty($userInfo)) {

            $weibos = DB::table('weibo')
                ->where('user_id','=',session::get('userInfo')->id)
                ->where('lock', 0)
                ->join('user_info', function($join){
                    $join->on('weibo.user_id', '=', 'user_info.id');
                })
                ->select('weibo.*', 'user_info.nickname')
                ->orderBy('time', 'desc')
                ->orderBy('comment', 'desc')
                ->skip(0)->take(10)
                ->get();

            return view('home.index',['weibos' => $weibos]);

        }else{

            //如果为空,遍历全部微博
            $weibos = DB::table('weibo')
                ->where('lock', 0)
                ->join('user_info', function($join){
                    $join->on('weibo.user_id', '=', 'user_info.id');
                })
                ->select('weibo.*', 'user_info.nickname')
                ->orderBy('time', 'desc')
                ->skip(0)->take(10)
                ->get();

            return view('home.index',['weibos' => $weibos]);
        }
        
    }

}
