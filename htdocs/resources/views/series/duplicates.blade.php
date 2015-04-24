@extends('master')

@section('title')
    Multiple series were found
@stop

@section('content')
    <h2>Choose one of the following series:</h2>

    <ul>
        @foreach($series as $serie)
            @if( SerieContainsExercises($serie->id) or (Auth::id() === $serie->makerId) )
                <h3><a href="{{ action('SeriesController@show', [$serie->id])}}">{{$serie->title}}</a></h3>
                <ul>
                    <?php $type = loadType2($serie->tId)[0]; ?>
                    <li>Description : {{$serie->description}}</li>
                    <li>Subject : {{$type->subject}}</li>
                    <li>Difficulty : {{$type->difficulty}}</li>
                </ul>
            @endif
        @endforeach
    </ul>

    @if ( Auth::check() )
        <h2><a href="series/create">Create new series</a></h2>
    @else
        <h2><a href="/login">User login</a></h2>
    @endif

@stop
