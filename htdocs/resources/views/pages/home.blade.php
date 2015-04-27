@extends('master')

@section('title')
    Welcome to Learn2Program
@stop


@section('head')
    <style>
        .jumbotron a {
            width: 200px;
        }
    </style>
    <link href="/css/web/style2.css" rel="stylesheet" type="text/css" media="all" />

@stop

@section('content')
@include('web.homepagebody')
@stop
