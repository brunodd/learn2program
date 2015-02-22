@extends('master')

@section('title')
    <h1>Edit <em>{{ $user->username }}'s</em> account</h1>
@stop

@section('content')
    <p>
        For now only allow username and password to be changed...
    </p>

    {!! Form::model($user, ['method' => 'PATCH']) !!}
        {!! Form::label('username', 'Username: ') !!}
        {!! Form::text('username') !!}

        {!! Form::label('pass', 'Password: ') !!}
        {!! Form::text('pass') !!}

        {!! Form::submit('Submit') !!}
    {!! Form::close() !!}
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif

@stop

