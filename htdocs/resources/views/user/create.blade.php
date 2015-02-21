@extends('master')

@section('title')
    <h1>Register as a new user</h1>
@stop

@section('content')
    {!! Form::open(['url' => 'user']) !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::password('pass') !!}

        {!! Form::submit('Submit') !!}
    {!! Form::close() !!}
@stop
