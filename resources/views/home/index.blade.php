@extends('demo')

@section('body-bgcolor','#D4D5E0')
@section('my-css')
<link rel="stylesheet" type="text/css" href="./css/all.css">
@stop

@section('content')
    @include('home.head')
    @include('home.body')
    @include('home.advertising')
@stop

@section('my-js')
    <script type="text/javascript" src="{{ asset('js/home/login.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home/weibo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home/fans.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home/advertising.js') }}"></script>  
@stop