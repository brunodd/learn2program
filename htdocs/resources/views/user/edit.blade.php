@extends('master')

@section('title')
    Edit <em>{{ $user->username }}'s</em> account
@stop

@section('content')
    <p> For now only allow username and password to be changed... </p>

    {!! Form::model($user, ['method' => 'PATCH']) !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::password('pass', null) !!}

        {!! Form::label('mail', 'Email: ') !!}
        {!! Form::text('mail') !!}

        {!! Form::submit('Submit') !!}
    {!! Form::close() !!}

    @include('errors.list')

@stop

