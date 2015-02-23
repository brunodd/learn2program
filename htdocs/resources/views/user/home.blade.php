@extends('master')

@section('title')
    <h1>Users home page</h1>
@stop

@section('content')
    <h2>Login Form:</h2>
    {!! Form::open() !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::text('pass') !!}

        {!! Form::submit('Login') !!}
    {!! Form::close() !!}
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="user/create">Registration page</a></h2>
@stop
