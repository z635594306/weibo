@extends('demo')

@section('title','账号设置')

@section('my-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home/chongzhi.css') }}">
@stop

@section('content')
	@include('home.head')
	<div class="container-fluid">
		<div class="row">
		    <div id="vip_bg"></div>
		</div>
	</div>
	<div style="width:100%;height:40px;"></div>
	<div class="container">
		<div class="row">
		    <div id="vip_main">
		    	<div class="col-md-3">
			    	<table class="table table-border">
			    		<tr>
			    			<th>1</th>
			    			<th>1</th>
			    		</tr>
			    		<tr>
			    			<td>3</td>
			    			<td>3</td>
			    		</tr>
			    	</table>
		    	</div>
		    	<div class="col-md-8 col-md-offset-1">qerq</div>
		    </div>
		</div>
	</div>
@stop

@section('my-js')

@stop
