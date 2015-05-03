@extends('master')

@section('title')
    Add a copy of an exercise to one of your series
@stop

@section('content')

    {!! Form::open() !!}
        {!! Form::label('series_selection', 'Choose one of your series: ') !!}
        {!! Form::select('series_selection', $series, "", ['class' => 'form-control']) !!}
	{!! Form::hidden('makerId', $exercise->makerId) !!}
	{!! Form::hidden('id', $exercise->id) !!}

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
	    {!! Form::textarea('expected_result', $exercise->expected_result, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
