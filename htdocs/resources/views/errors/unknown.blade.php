@extends('master')

@section('title')
    Error
@stop

@section('content')
    <h2>{{ $msg }}</h2>
    <h3>{{ $alert }}</h3>

    <em><a href='/'>Home</a></em>
@stop
