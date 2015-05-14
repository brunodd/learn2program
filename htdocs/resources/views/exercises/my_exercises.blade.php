@extends('master')

@section('title')
    Your exercises
@stop

@section('content')
    <ul>
        @foreach($exercises as $ex)
            <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">{{ firstChars($ex->question, 50) }}</a></h3>
        @endforeach
    </ul>


@stop
