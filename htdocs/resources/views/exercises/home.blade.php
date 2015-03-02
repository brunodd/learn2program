@extends('master')

@section('title')
    Exercise home page
@stop

@section('content')
    <h2>List of all exercises:</h2>

    <ul>
    @foreach($exercises as $ex)
        <h3><a href="{{ action('ExercisesController@show', [$ex->id])}}">ID {{$ex->id}} or perhaps some title?</a></h3>
    @endforeach
    </ul>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="/register">Registration page</a></h2>
@stop
