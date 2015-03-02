@extends('master')

@section('title')
    Exercise home page
@stop

@section('content')
    <h2>List of all series:</h2>

    <ul>
    @foreach($series as $serie)
    @if( SerieContainsExercises($serie->id) or (Auth::id() === $serie->makerId) )
        <h3><a href="{{ action('SeriesController@show', [$serie->id])}}">{{$serie->title}}</a></h3>
        <p>{{$serie->description}}</p>
    @endif
    @endforeach
    </ul>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="series/create">Create new series</a></h2>
    <h2><a href="/register">Registration page</a></h2>
@stop
