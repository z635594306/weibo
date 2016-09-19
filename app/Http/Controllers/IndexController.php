<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Session;

class IndexController extends Controller
{
    public function index()
    {
        $weibos = DB::table('weibo')->orderBy('time', 'desc')->orderBy('comment', 'desc')->skip(0)->take(10)->get();
        return view('home.index',['weibos' => $weibos]);
    }
}
