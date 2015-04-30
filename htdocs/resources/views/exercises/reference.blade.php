@extends('master')

<?php
    $fullExercises = loadAllExercises();
    $titles = [];
    $start_code = [];
    $tips = [];
    $expected_result = [];
    $exId = [];
    $makerId = [];
    foreach($fullExercises as $ex) {
        array_push($titles, $ex->question);
        array_push($start_code, $ex->start_code);
        array_push($tips, $ex->tips);
        array_push($expected_result, $ex->expected_result);
        array_push($exId, $ex->id);
        array_push($makerId, $ex->makerId);
    }
?>
@section('title')
    Add a reference of an exercise for series: {{$serie->title}}
@stop

@section('content')
    <script>
        // Need to add the selected id so I can use queries to find the useful data.
        function fillAll(id) {
            document.getElementById("question").value = <?php echo(json_encode($titles));?>[id];
            document.getElementById("start_code").value = <?php echo(json_encode($start_code));?>[id];
            document.getElementById("tips").value = <?php echo(json_encode($tips));?>[id];
            document.getElementById("expected_result").value = <?php echo(json_encode($expected_result));?>[id];
            document.getElementById("id").value = <?php echo(json_encode($exId));?>[id];
            document.getElementById("makerId").value = <?php echo(json_encode($makerId));?>[id];
        }
    </script>


    {!! Form::open() !!}
        {!! Form::label('exercise_selection', 'Choose the exercise: ') !!}
        {!! Form::select('exercise_selection', $titles, "", ['class' => 'form-control', 'onchange'=>'fillAll(this.selectedIndex)']) !!}
        {!! Form::label('makerId', 'makerId',  ['style' => 'display: none;']) !!}
        {!! Form::hidden('makerId', null) !!}

        <div class="form-group">
            {!! Form::label('id', 'ID',  ['style' => 'display: none;']) !!}
            {!! Form::hidden('id', null) !!}
        </div>

        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
            {!! Form::text('question', null, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
            {!! Form::textarea('start_code', null, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
            {!! Form::textarea('tips', null, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            {!! Form::textarea('expected_result', null, ['class' => 'form-control', 'readonly']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
