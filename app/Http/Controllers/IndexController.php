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
    public function index($page=0)
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
                ->simplePaginate(10);

                //处理时间
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

            if (!$page) {
                return view('home.index',['weibos' => $weibos]);
            }else{
                return $weibos;
            }

        }else{

            //如果为空,遍历全部微博
            $weibos = DB::table('weibo')
                ->where('lock', 0)
                ->join('user_info', function($join){
                    $join->on('weibo.user_id', '=', 'user_info.id');
                })
                ->select('weibo.*', 'user_info.nickname')
                ->orderBy('time', 'desc')
                ->simplePaginate(10);

                //处理时间
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

            if (!$page) {
                return view('home.index',['weibos' => $weibos]);
            }else{
                return $weibos;
            }
        }
        
    }


    

}
