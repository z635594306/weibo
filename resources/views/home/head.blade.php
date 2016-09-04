@extends('demo')

@section('my-css')
<link rel="stylesheet" type="text/css" href="./css/all.css">
@stop

@section('content')
    <div class="container-fluid" style="border-top:2px solid #fa7d3c;box-shadow:0 0 1px 0 rgba(0, 0, 0, 0.3), 0 0 6px 2px rgba(0, 0, 0, 0.15)">
        <div class="col-md-12">
            <div class="row" id="top">
                <!-- logo -->
                <div class="col-md-2 hidden-xs">
                    <div class="pull-right"><a href=""><img src="./imgs/logo_big.png" height="40px"></a></div>
                </div>
                <!-- logo-end -->
                <!-- search -->
                <div class="col-md-4">
                    <form class="form-horizontal col-md-12">
                      <div class="form-group" style="margin-bottom: 0px;">
                        <div class="input-group col-md-12" style="margin-top: 7px;">
                            <input type="text" class="form-control" id="search" placeholder="大家都在搜：贱婊子马蓉">
                            <span class="input-group-btn">  
                                <button class="btn btn-default" id="test-button" type="button"><span class="glyphicon glyphicon-search"></span></button>  
                            </span>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- search-end -->
                <div class="col-md-4 col-md-offset-2 hidden-xs">
                    <ul id="top-nuv">
                        <li><span class="glyphicon glyphicon-home nuv-ico"> </span> 首页</li>
                        <li><span class="glyphicon glyphicon-gift nuv-ico"> </span> 发现</li>
                        <li>注册&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop