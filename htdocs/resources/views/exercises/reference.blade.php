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
    <script>
        function fillAll() {
            document.getElementById("question").value = "Put needed question here";
            document.getElementById("start_code").value = "Put needed start code here";
            document.getElementById("tips").value = "Put needed tips here";
            document.getElementById("expected_result").value = "Put needed expected result here";
        }
    </script>


    {!! Form::open() !!}
        {!! Form::select('Exercise', $titles, null, ['class' => 'form-control']) !!}
        {!! Form::button('Check exercise', ['class' => 'btn btn-primary form-control', 'onclick' => 'fillAll()']) !!}

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
