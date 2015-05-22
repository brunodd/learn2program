@extends('master')

@section('title')
    Edit your exercise and all its references.
@stop

@section('content')
    <h3>Series that are subject to your changes :</h3>
    <table style="width:50%">
    <tr>
    <td><h4>Title</h4></td>
    <td><h4>Subject</h4></td>
    <td><h4>Difficulty</h4></td>
    </tr>
    @foreach( $subjectSeries as $serie )
        <tr>
        <td><em>{{ $serie->title }}</em></td>
        <td><em>{{ loadType2($serie->tId)[0]->subject }}</em></td>
        <td><em>{{ loadType2($serie->tId)[0]->difficulty }}</em></td>
        </tr>
    @endforeach
    </table> <br \>

    {!! Form::open(['url' => ['exercises', $exercise->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
            {!! Form::text('question', $exercise->question, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
            {!! Form::textarea('start_code', $exercise->start_code, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
            {!! Form::textarea('tips', $exercise->tips, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            <p>Note: If you wish to create an exercise from which the result should/can not be verified <i>(e.g. turtle graphics)</i>.
            Please enter ' <font size="4">*</font> ' as the answer <i>(without the <b>'</b>-signs)</i>.
            </p>
            {!! Form::textarea('expected_result', $exercise->expected_result, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <div style="color: white;">
                <a href="{{ action('ExercisesController@show', $exercise->id )}}" class="btn btn-primary pull-right" style="margin-left: 5px">
                    <i class="glyphicon glyphicon-remove-sign"></i> Cancel
                </a>
            </div>
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right']) !!}
        </div>
        <div style="clear:both;"></div>
    {!! Form::close() !!}
    @include('errors.list')
    <div style="height: 25px"></div>
    @stop

