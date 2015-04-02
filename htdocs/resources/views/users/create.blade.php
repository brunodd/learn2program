@extends('master')

@section('title')
    Register as a new user
@stop

@section('content')
    {!! Form::open(['url' => 'users', 'files' => 'true']) !!}
        <div class="form-group">
            {!! Form::label('username', 'Username: ') !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass', 'Password: ') !!}
            {!! Form::password('pass', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('mail', 'E-mail address: ') !!}
            {!! Form::email('mail', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Choose profile image: ') !!}
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')

@stop
