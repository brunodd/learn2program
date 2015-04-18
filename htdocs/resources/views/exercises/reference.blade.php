@extends('master')

<?php
    $fullExercises = loadAllExercises();
    $titles = [];
    foreach($fullExercises as $ex) {
        array_push($titles, [$ex->question]);
    }
?>
@section('title')
    Add a reference of an exercise for series: {{$serie->title}}
@stop

@section('content')
    {!! Form::open() !!}
        {!! Form::select('Exercise', $titles, null, ['class' => 'form-control']) !!}
        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
            {!! Form::text('question', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
            {!! Form::textarea('start_code', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
            {!! Form::textarea('tips', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            {!! Form::textarea('expected_result', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
