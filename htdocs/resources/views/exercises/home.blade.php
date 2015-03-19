@extends('master')

@section('title')
    Exercise home page
@stop

@section('content')
    <h2>List of all exercises:</h2>

    <ul>
    @foreach($exercises as $ex)
    <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">{{ first20chars($ex->question) }}</a></h3>
    @endforeach
    </ul>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @if ( !Auth::check() )
    <h2><a href="/login">User login</a></h2>
    @endif
@stop
