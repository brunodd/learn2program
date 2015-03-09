@extends('master')

@section('title')
    Series home page
@stop

@section('content')
    <h2>List of all series:</h2>

    <ul>
    @foreach($series as $serie)
    @if( SerieContainsExercises($serie->id) or (Auth::id() === $serie->makerId) )
    <h3><a href="{{ action('SeriesController@show', [$serie->title])}}">{{$serie->title}}</a></h3>
    @endif
    @endforeach
    </ul>

    @if ( Auth::check() )
    <h2><a href="series/create">Create new series</a></h2>
    @else
    <h2><a href="/login">User login</a></h2>
    @endif

@stop
