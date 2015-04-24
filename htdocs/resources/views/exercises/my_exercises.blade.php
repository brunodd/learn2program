@extends('master')

@section('title')
    Your exercises
@stop

@section('content')
    <h2>List of all exercises:</h2>

    <ul>
        @foreach($exercises as $ex)
            <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">{{ first20chars($ex->question) }}</a></h3>
        @endforeach
    </ul>


    <div style="height: 50px;"></div>
    <h5><a href="exercises/create">Create new exercise</a></h5>
@stop
