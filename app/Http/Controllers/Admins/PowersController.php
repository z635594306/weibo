<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PowersController extends Controller
{
   //分页浏览信息 
    public function powers(Request $request)
    {
        $db = \DB::table("user_login");
        //判断并封装搜索条件
        $where = [];
        if($request->has("keyword")){
            $kw = $request->input("keyword");
            $db->where("email","like","%{$kw}%")->orwhere("email","like","%{$kw}%");
            $where['keyword'] = $kw;
        }
       
        
        $list = $db->paginate(3); //获取所有信息
        return view("admins.powers.powers",["list"=>$list,"where"=>$where]);
    }

     //执行修改
    public function update($id, $lock, Request $request)
    {
    	if (!$lock) {
    		$src = \DB::table('user_login')
    		->where('id', $id)
    		->update(['lock' => 1]);
    		$db = \DB::table("user_login");
        //判断并封装搜索条件
        $where = [];
        if($request->has("keyword")){
            $kw = $request->input("keyword");
            $db->where("email","like","%{$kw}%")->orwhere("email","like","%{$kw}%");
            $where['keyword'] = $kw;
        }
       
        
        $list = $db->paginate(10); //获取所有信息
        return view("admins.powers.powers",["list"=>$list,"where"=>$where]);
    	}
    	$src = \DB::table('user_login')
    		->where('id', $id)
    		->update(['lock' => 0]);
    		$db = \DB::table("user_login");
        //判断并封装搜索条件
        $where = [];
        if($request->has("keyword")){
            $kw = $request->input("keyword");
            $db->where("email","like","%{$kw}%")->orwhere("email","like","%{$kw}%");
            $where['keyword'] = $kw;
        }
       
        
        $list = $db->paginate(10); //获取所有信息
        return view("admins.powers.powers",["list"=>$list,"where"=>$where]);
    }
}