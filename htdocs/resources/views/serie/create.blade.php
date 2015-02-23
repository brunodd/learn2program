@extends('master')

@section('title')
    <h1>Create a new serie</h1>
@stop

@section('content')
    {!! Form::open(['url' => 'serie']) !!}
        <div class="form-group">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('description', 'Description: ') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('subject', 'Subject: ') !!}
        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('difficulty', 'Difficulty: ') !!}
        {!! Form::select('difficulty', ['' => '', 'easy' => 'Easy', 'intermediate' => 'Intermediate', 'hard' => 'Hard', 'insane' => 'Insane'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Create serie', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
