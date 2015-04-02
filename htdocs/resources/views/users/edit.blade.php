@extends('master')

@section('title')
    Edit <em>{{ $user->username }}'s</em> account
@stop

@section('content')
    {!! Form::model($user, ['method' => 'PATCH', 'files' => 'true']) !!}
        <div class="form-group">
            {!! Form::label('username', 'Username: ') !!}
            {!! Form::text('username') !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass', 'Password: ') !!}
            {!! Form::password('pass', null) !!}
        </div>

        <div class="form-group">
            {!! Form::label('mail', 'Email: ') !!}
            {!! Form::text('mail') !!}
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Choose profile image: ') !!}
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save') !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')

@stop

