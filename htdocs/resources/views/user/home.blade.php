@extends('master')

@section('title')
    Member
@stop

@section('content')
    <h2>Login Form:</h2>
    {!! Form::open(['url' => 'user/login']) !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::password('pass') !!}

        {!! Form::submit('Login') !!}
    {!! Form::close() !!}

    @include('errors.list')

    <h2><a href="user/create">Registration page</a></h2>
@stop
