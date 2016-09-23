<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

use Session;

class ZoneController extends Controller
{
    public function index()
    {   
        $id = session::get('userInfo')->id;
        $data = DB::table('user_info')->where('id',$id)->first();
        return view('home.centerone', ['vo'=>$data]);

    }    
}


