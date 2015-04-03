@extends('master')

@section('title')
    Edit <em>{{ $user->username }}'s</em> account
@stop

@section('content')
    {!! Form::model($user, ['url' => '/users/' . $user->username, 'method' => 'PATCH', 'files' => 'true']) !!}
        {!! Form::hidden('userId', $user->id) !!}
        {!! Form::hidden('oldUsername', $user->username) !!}

        <div class="form-group">
            {!! Form::label('username', 'New Username: ') !!}
            {!! Form::text('username') !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass', 'New Password: ') !!}
            {!! Form::password('pass') !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass_confirmation', 'Confirm Password: ') !!}
            {!! Form::password('pass_confirmation') !!}
        </div>

        <div class="form-group">
            {!! Form::label('mail', 'New Email: ') !!}
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

