@extends('demo')

@section('title','兄弟连微博－注册')

@section('my-css')
    <link rel="stylesheet" type="text/css" href="css/home/reg.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
@stop

@section('content')
    <div class="container-fluid" style="background:url(imgs/reg_repeat_bg.png)">
        <div class="col-md-8 col-md-offset-2">
            <!-- head -->
            <div class="row">
                <div id="reg-logo-bg">
                    <div class="" id="reg-logo" style="background:url(imgs/logo_big.png)"></div>
                </div>
            </div>
            <!-- head end -->

            <!-- body -->
            <div class="row">
                <div class="col-md-12" id="reg-form-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>个人注册</h2>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-md-9">
                            <form class="form-horizontal col-md-12" action="" method="post" onSubmit="return false">
                                <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"><span class="glyphicon glyphicon-envelope"> </span><span class="text-red"> * </span>电子邮箱</label>
                                    <div class="col-sm-5">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="请输入可用的电子邮箱" maxlength="30">
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="error">
                                            <span class="glyphicon glyphicon-exclamation-sign error-ico"></span>
                                            <span class="error-text"> 请输入您的常用邮箱 </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label"><span class="glyphicon glyphicon-lock"> </span><span class="text-red"> * </span>设置密码</label>
                                    <div class="col-sm-5"> <input type="password" name="pwd" class="form-control" id="pwd"  placeholder="请输入密码" maxlength="16"> </div>
                                    <div class="col-sm-4">
                                        <span class="error">
                                            <span class="glyphicon glyphicon-exclamation-sign error-ico"></span>
                                            <span class="error-text"> 请输入6-16位数字、字母或常用符号，字母区分大小写 </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label"><span class="glyphicon glyphicon-font"> </span><span class="text-red"> * </span>验证码　</label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon code";>  
                                                <img src="{{ URL('/captcha/'.time()) }}" name="code" onclick="this.src = this.src+ '&i=' + Math.round()">
                                            </span>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="验证码" maxlength="4">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="error">
                                            <span class="glyphicon glyphicon-exclamation-sign error-ico"></span>
                                            <span class="error-text"> 验证码不区分大小写 </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="button" onclick="reg()" class="btn btn-warning col-md-12" id="reg-btn"><span class="h4">立 即 注 册</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 hidden-xs" id="reg-box">
                            <div class="row">
                                <div class="col-md-12" id="go-login"><p>已有账号<a href="{{ URL('') }}" class="text-red" id="goLogin">直接登录 >>></a></p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><div id="xian"> </div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-50" id="logo"><img src="./imgs/100447416110.jpg" class="col-md-12" ></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body end -->
            <!-- foot -->
            <div class="col-md-12">
                <div class="row mt-10 mb-10">
                    <div class="col-md-8 col-md-offset-2"><span class="foot-text">上海兄弟连S49期PHP就业班A小组</span> <span class="pull-right foot-text">Copyright © 2009-2016 XDL </span></div>
                </div>
            </div>
            <!-- foot end -->
        </div>
    </div>
@stop

@section('my-js')
    <script type="text/javascript" src="js/home/reg.js"></script>
@stop