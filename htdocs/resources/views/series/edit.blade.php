@extends('master')

@section('title')
    Edit serie <em>{{ $serie->title }}</em>
@stop

@section('content')
    <p> For now, everything can be updated... </p>

    <!-- TODO: armin PUT vs PATCH -->
    {!! Form::model($serie, ['url' => '/series/' . $serie->title, 'method' => 'PUT']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::model($type, ['method' => 'PATCH']) !!}
        <div class="form-group">
            {!! Form::label('subject', 'Subject: ') !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('difficulty', 'Difficulty: ') !!}
            {!! Form::select('difficulty', ['' => '', 'easy' => 'Easy', 'intermediate' => 'Intermediate', 'hard' => 'Hard', 'insane' => 'Insane'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::hidden('id', $serie->id) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update serie', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop

