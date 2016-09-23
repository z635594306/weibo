@extends('demo')

@section('title','账号设置')

@section('my-css')
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/home/centerone.css">
@stop

@section('content')
    @include('home.head')
    <div class="container-fluid" style="background:url(./imgs/body_bg_page.jpg) no-repeat;">
	    <div class="container">
	    <div style="height:18px;"></div>
		  <div class="col-md-10 col-md-offset-1">
		  	<!-- 封面开始 -->
		  	<div class="container-fluid" style="background:url(./imgs/bg_1.jpg) no-repeat;height:300px;">
			  	<div class="container-fluid" style="height:150px;">
			  		<div id="face100" style="height:100px;width:100px;"><img src="holder.js/100x100" class="img-circle"></div>
			  	</div>

		  		<div class="container-fluid" id="nickname">
		  			<h1>{{ $vo->nickname }}</h1>
		  		</div>
		  		<div class="container-fluid" id="intro">{{ $vo->intro }}</div>

		  		<div class="dropdown col-md-offset-10">
			  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
			    会员充值
			    	<span class="caret"></span>
			  	</button>
			  	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			    	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL('/center/chongzhi/1')}}">1个月</a></li>
			   		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL('/center/chongzhi/2')}}">3个月</a></li>
			   		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL('/center/chongzhi/3')}}">6个月</a></li>
			    	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL('/center/chongzhi/4')}}">12个月</a></li>
			  	</ul>
			</div>
		  	</div>
		  	<div style="background-color:#FFFFFF;height:40px;margin-bottom:18px;">
		  		<div style="width:60%;margin:0 auto;">
		  			<table cellpadding="0" cellspacing="0" id="table">
		  				<tr>
		  					<td><a href="">我的主页</a></td>
		  					<td><a href="">我的相册</a></td>
		  				</tr>
		  			</table>
		  		</div>
		  	</div>
		  	

		  	<!-- 封面结束 -->

		  	<div class="col-md-4">
		  		<!-- 账户信息 关注 粉丝 微博 开始 -->
		  		<div  style="background-color:#FFFFFF;height:50px;border-radius:5px;margin-bottom:18px;">
		  			<div>
		  				
		  					<table id="table_fans">
		  						<tr>
		  							<td><a href=""><strong>{{ $vo->follow }}</strong><span>关注</span></a></td>
		  							
		  							<td><a href="" id="th-2"><strong>{{ $vo->fans }}</strong><span>粉丝</span></a></td>
		  							
		  							<td><a href=""><strong>{{ $vo->weibo }}</strong><span>微博</span></a></td>
		  						</tr>
		  					</table>
		  				
		  			</div>
		  			<!-- 账户信息 关注 粉丝 微博 结束 -->	
		  		</div>
		  		<div style="background-color:red;height:50px;border-radius:5px;">在上面这下的木块写在这里</div>
		  	</div>
		  		

	  		<!-- 账户微博 遍历 开始-->
	  		<div class="col-md-7" style="background-color:blue;height:50px;border-radius:5px;">
	  			
	  		</div>
	  		<!-- 账户微博 遍历 结束-->
		  	
		  </div>
		</div>
    </div>
@stop

@section('my-js')

@stop