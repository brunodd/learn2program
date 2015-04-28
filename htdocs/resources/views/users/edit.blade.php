@extends('master')

@section('title')
    Edit your account
@stop

@section('content')
    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-md-offset-2">
        {!! Form::model($user, ['url' => '/users/' . $user->username, 'method' => 'PUT', 'files' => 'true', 'role' => 'form']) !!}
            {!! Form::hidden('userId', $user->id) !!}
            {!! Form::hidden('oldUsername', $user->username) !!}

            <div class="form-group">
                {!! Form::label('username', 'New Username: ') !!}
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'New Username', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('pass', 'New Password: ') !!}
                {!! Form::password('pass', ['class' => 'form-control', 'placeholder' => 'Leave blank if you dont wan\'t to change', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('pass_confirmation', 'Confirm Password: ') !!}
                {!! Form::password('pass_confirmation', ['class' => 'form-control', 'placeholder' => 'Leave blank if you dont wan\'t to change']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('mail', 'New Email: ') !!}
                {!! Form::text('mail', null, ['class' => 'form-control', 'placeholder' => 'New Email', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('info', 'Tell us about yourself: ') !!}
                {!! Form::text('info', null, ['class' => 'form-control', 'placeholder' => 'Don\'t be shy!']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Choose profile image: ') !!}
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>

    @include('errors.list')
@stop

