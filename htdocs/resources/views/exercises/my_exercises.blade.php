@extends('master')

@section('title')
    Your exercises
@stop

@section('content')
    <ul>
        @foreach($exercises as $ex)
            <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">{{ first20chars($ex->question) }}</a></h3>
        @endforeach
    </ul>


@stop
