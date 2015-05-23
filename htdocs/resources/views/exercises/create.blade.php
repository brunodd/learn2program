@extends('master')

@section('title')
    Create a new exercise for {{$serie->title}}
@stop

@section('content')
    {!! Form::open() !!}
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
            {!! Form::label('language', 'Language: ') !!}
            {!! Form::select('language', array("python"=>"python", "cpp"=>"cpp"), ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            <p>Note 1: The answer checks use regular expressions to match the generated result. If you want to match an exact answer, surround the expected result with the '^' and '$' symbols.
            For example: to match the string 'foo bar'. Enter ^foo bar$, if you merely want to check if the string 'foo' is in the text, just foo will suffice. 
            <em>(If you need some reminders on using regular expressions, visit <a href=http://lzone.de/examples/PHP%20preg_match>this cheat sheet</a>.)</em>
            </p>
            <p>Note 2: If you wish to create an exercise from which the result should/can not be verified <i>(e.g. turtle graphics)</i>.
            Please enter ' <font size="4">*</font> ' as the answer <i>(without the <b>'</b>-signs)</i>.
            </p>
            {!! Form::textarea('expected_result', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
