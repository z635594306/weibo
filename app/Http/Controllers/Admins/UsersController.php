<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends CommonController
{
    //分页浏览信息 
    public function index(Request $request)
    {
        $db = \DB::table("user_login");
        //分页 判断并封装搜索条件
        $where = [];
        if($request->has("keyword")){
            $kw = $request->input("keyword");
            $db->where("email","like","%{$kw}%")->orwhere("email","like","%{$kw}%");
            $where['keyword'] = $kw;
        }
        //获取所有信息
        $list = $db->paginate(4);
        
        return view("admins.users.index",["list"=>$list,"where"=>$where]);
    }
    
    //浏览详情信息
    public function show($id)
    {
        return "详情".$id;
    }
    
    //添加表单
    public function create()
    {
        return view("admins.users.add");
    }
    
    //执行添加
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|max:20|min:3',
        ]);
        //判断重复密码
        if($request->input("password")!=$request->input("repassword")){
            return back()->with("err","密码和重复密码不一致!");
        }
        
        //获取指定的部分数据
        $data = $request->only("email","password");
        $data['password'] = $data['password'];
        $data['registime'] = time();
        $id = \DB::table("user_login")->insertGetId($data);
        
        if($id>0){
            return redirect('admins/users');
        }else{
           return back()->with("err","添加失败!");
        }
    }
    
    //执行删除
    public function destroy($id)
    {
        
            \DB::table("user_login")->where("id",$id)->delete();
            return redirect('admins/users');
    }
    
    //加载修改表单
    public function edit($id)
    {
        $users = \DB::table("user_login")->where("id",$id)->first(); //获取要编辑的信息
        // dd($users);
        return view("admins.users.edit",["vo"=>$users]);
    }
    
    //执行修改
    public function update($id,Request $request)
    {
        //表单验证
        // return "213";
        // dd($request);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|max:20|min:3',
        ]);
        $data = $request->only("email","password");
        $data['registime'] = time();
        $id = \DB::table("user_login")->where("id",$id)->update($data);
        // dd($id);
        
        if($id>0){
            return redirect('admins/users');
        }else{
            return back()->with("err","修改失败!");
        }
        
    }
    
    // 为当前用户准备分配角色信息
    public function loadRole($uid=0)
    {
        //获取所有角色信息
        // $rolelist = \DB::table("role")->get();

        $rolelist = \DB::select('select * from role');
        //获取当前用户的角色id
        // $rids = \DB::table("user_role")->where("uid",$uid)->pluck("rid");
        $rids = \DB::select('select rid from user_role where uid='.$uid);
        $rid = [];
        foreach($rids as $k=>$v){
            $rid[$k] = $v->rid;
        }

     


        //加载模板
        return view("admin.users.rolelist",["uid"=>$uid,"rolelist"=>$rolelist,"rids"=>$rid]);
    }
    
    public function saveRole(Request $request){
        $uid = $request->input("uid");
        //清除数据
        \DB::table("user_role")->where("uid",$uid)->delete();
        
        $rids = $request->input("rids");
        if(!empty($rids)){
            //处理添加数据
            $data = [];
            foreach($rids as $v){
                $data[] = ["uid"=>$uid,"rid"=>$v];
            }
            //添加数据
            \DB::table("user_role")->insert($data);
        }
        return "角色保存成功!";
    }
}
