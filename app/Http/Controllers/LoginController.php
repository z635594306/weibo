<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
class LoginController extends Controller
{
    /*
    *functin : 执行登陆
    *
    *
    */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $pwd = md5($request->input('pwd'));
        $code = $request->input('code');

        
        return $email.$pwd.$code;
    }
}
