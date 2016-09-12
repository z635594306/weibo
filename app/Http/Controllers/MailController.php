<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = ['email'=>'635594306@qq.com', 'name'=>'用户'];
        Mail::send('mail.mail', $data, function($message) use($data)
        {
            $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
        });
    }
}
