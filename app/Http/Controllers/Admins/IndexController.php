<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;


class IndexController extends CommonController
{
    //
    public function index()
    {
    	return view("admins.index.index");
    }
}
