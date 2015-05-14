@extends('master')

@section('title')
    Exercises
@stop

@section('content')
    <h2>List of all exercises:</h2>

    <ul>
        @foreach($exercises as $ex)
            <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">{{ firstChars($ex->question, 50) }}</a></h3>
        @endforeach
    </ul>
@stop
