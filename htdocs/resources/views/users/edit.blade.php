@extends('master')

@section('title')
    Edit <em>{{ $user->username }}'s</em> account
@stop

@section('content')
    <!-- TODO: armin PUT vs PATCH -->
    {!! Form::model($user, ['url' => '/users/' . $user->username, 'method' => 'PUT', 'files' => 'true']) !!}
        {!! Form::hidden('userId', $user->id) !!}
        {!! Form::hidden('oldUsername', $user->username) !!}

        <div class="form-group">
            {!! Form::label('username', 'New Username: ') !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass', 'New Password: ') !!}
            {!! Form::password('pass', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass_confirmation', 'Confirm Password: ') !!}
            {!! Form::password('pass_confirmation', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('mail', 'New Email: ') !!}
            {!! Form::text('mail', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('info', 'Tell us about yourself: ') !!}
            {!! Form::text('info', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Choose profile image: ') !!}
            {!! Form::file('image', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')

@stop

