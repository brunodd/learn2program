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
    @include('web.homepagehead')
@stop

@section('content')
    @include('web.homepagebody')
@stop
