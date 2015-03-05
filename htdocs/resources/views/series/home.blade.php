@extends('master')

@section('title')
    Series home page
@stop

@section('content')
    <h2>List of all series:</h2>

    <ul>
    @foreach($series as $serie)
    @if( SerieContainsExercises2($serie->id) or (Auth::id() === $serie->makerId) )
        <h3><a href="{{ action('SeriesController@show', [$serie->title])}}">{{$serie->title}}</a></h3>
        <p>{{$serie->description}}</p>
    @endif
    @endforeach
    </ul>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    @if ( Auth::check() )
    <h2><a href="series/create">Create new series</a></h2>
    @else
    <h2><a href="/login">User login</a></h2>
    @endif

@stop
