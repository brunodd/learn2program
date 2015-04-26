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


    <div style="height: 50px;"></div>
    <h3><a href="exercises/create">Create new exercise</a></h3s>
@stop
