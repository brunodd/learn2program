@extends('master')

@section('title')
    Member
@stop

@section('content')
    <h2>Login Form:</h2>
    {!! Form::open() !!}
        echo "LOGIN FORM";
    {!! Form::close() !!}
    <h2><a href="user/create">Registration page</a></h2>
@stop
