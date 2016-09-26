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

        $hotPersons = DB::table('user_info')
            ->orderBy('fans', 'desc')
            ->take(8)
            ->get();
        // dd($hotPersons);
        session::set('hotPerson', $hotPersons);

        //判断用户session是否为空,不为空显示用户及粉丝微博
        $userInfo = session::get('userInfo');
        if (!empty($userInfo)) {
            $userInfo = DB::table('user_info')->where('id', $userInfo->id)->first();

            session::set('userInfo', $userInfo);
            //查询用户微博
            $weibos = DB::table('weibo')
                ->where('user_id','=',session::get('userInfo')->id)
                ->where('lock', 0)
                ->join('user_info', function($join){
                    $join->on('weibo.user_id', '=', 'user_info.id');
                })
                ->select('user_info.*', 'weibo.*')
                ->orderBy('weibo.time', 'desc')
                ->simplePaginate(10);

            $num = 10-count($weibos);
            //查询粉丝微博
            $last = DB::table('fans')
                ->join('user_info', 'user_info.id', '=', 'fans.follow_id')
                ->join('weibo', 'weibo.user_id', '=', 'user_info.id')
                ->where('fans.my_id',session::get('userInfo')->id)
                ->where('weibo.lock', 0)
                ->select('user_info.*', 'weibo.*')
                ->orderBy('weibo.time', 'desc')
                ->simplePaginate(10);

            foreach ($last as $k => $v) {
                $weibos[] = $v;
            }
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
                ->select('user_info.*', 'weibo.*')
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


    public function findWeibo(Request $request)
    {
        // $find = '农村';
        $find = $request->input('find');
        $weibos = DB::table('weibo')
            ->where('lock', 0)
            ->where('content', 'like', '%'.$find.'%')
            ->join('user_info', 'user_info.id', '=', 'weibo.user_id')
            ->select('user_info.*', 'weibo.*')
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
        return view('home.index',['weibos' => $weibos]);
    }

}
