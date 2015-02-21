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
        
        {!! Form::label('mail', 'E-mail address: ') !!}
        {!! Form::email('mail') !!}

        {!! Form::submit('Submit') !!}
    {!! Form::close() !!}

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
@stop
