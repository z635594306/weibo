<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use DB;

class FansController extends Controller
{

    public function AddFollow(Request $request)
    {
        $myId = $request->input('myId');
        $followId = $request->input('followId');

        $res = DB::table('fans')
            ->where(['my_id'=>$myId, 'follow_id'=>$followId])
            ->take(1)
            ->get();

        if (empty($res[0])) {
            $id = DB::table('fans')
                ->insertGetId(
                        ['my_id'=>session::get('userInfo')->id,
                        'follow_id'=>$followId,
                        'time'=>time()]
                    );
            if ($id) {
                DB::table('user_info')->where('id', $myId)->increment('follow');
                DB::table('user_info')->where('id', $followId)->increment('fans');
                return $message = array('error'=>0, 'message'=>'关注成功');
            }
                return $message = array('error'=>1, 'message'=>'添加失败');
        }

        return $message = array('error'=>2, 'message'=>'已经关注过了');

    }

    public function DelFollow(Request $request)
    {
        $myId = $request->input('myId');
        $followId = $request->input('followId');

        $res = DB::table('fans')->where(['my_id'=>$myId, 'follow_id'=>$followId])->delete();

        if ($res) {
            DB::table('user_info')->where('id', $myId)->decrement('follow');
            DB::table('user_info')->where('id', $followId)->decrement('fans');
        }

        return $res;
    }

    public function LookFollow(Request $request)
    {
        $my_id = $request->input('userId');

        $too = DB::table('fans as a')
            ->where('b.my_id', $my_id)
            ->join('user_info', 'user_info.id', '=', 'a.my_id')
            ->join('fans as b', 'b.follow_id', '=', 'a.my_id')
            ->get();
        $arr = array();

        foreach ($too as $key => $value) {
            $arr[] = $value->id;
        }

        $follow = DB::table('fans')
            ->join('user_info', 'user_info.id', '=', 'fans.follow_id')

            ->where('my_id', $my_id)
            ->whereNotIn('fans.id', $arr)
            ->select('user_info.*','fans.*')
            ->get();

        $data = array($too, $follow);

        return $data;
    }



    public function LookFans(Request $request)
    {
        $my_id = $request->input('userId');

        $too = DB::table('fans as a')
            ->where('b.follow_id', $my_id)
            ->join('user_info', 'user_info.id', '=', 'a.follow_id')
            ->join('fans as b', 'a.follow_id', '=', 'b.my_id')
            ->get();
        $arr = array();

        foreach ($too as $key => $value) {
            $arr[] = $value->id;
        }

        $follow = DB::table('fans')
            ->join('user_info', 'user_info.id', '=', 'fans.my_id')
            ->where('follow_id', $my_id)
            ->whereNotIn('fans.id', $arr)
            ->select('user_info.*','fans.*')
            ->get();

        $data = array($too, $follow);

        return $data;
    }

}
