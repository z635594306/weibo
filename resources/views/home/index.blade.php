@extends('demo')

@section('body-bgcolor','#D4D5E0')
@section('my-css')
<link rel="stylesheet" type="text/css" href="./css/all.css">
@stop

@section('content')
    @include('home.head')
    @include('home.body')
@stop