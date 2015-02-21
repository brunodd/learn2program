@extends('master')

@section('title')
    <h1>Edit <em>{{ $user->username }}'s</em> account</h1>
@stop

@section('content')
    <p>
        For now just a form that will (again) create a new user...
    </p>
    <p>
        TODO: change data instead of adding (mind autoincrementing ID).
    </p>
    {!! Form::open(['url' => 'user']) !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::password('pass') !!}

        {!! Form::submit('Submit') !!}
    {!! Form::close() !!}
@stop

