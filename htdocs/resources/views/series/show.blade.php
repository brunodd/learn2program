@extends('master')

@section('title')
    <em>{{ $serie->title }}'s</em> page <br>
    <small>
        Subject : {{$type->subject}}<br>
        Difficulty : {{$type->difficulty}}
        @if( Auth::check() and isMakerOfSeries($serie->id, Auth::id()) )
            <br>
            @if( count(loadSerieWithIdOrTitle($serie->title)) === 1 )
                <a href="{{ action('SeriesController@edit', $serie->title )}}">Edit</a>
            @else
                <a href="{{ action('SeriesController@edit', $serie->id )}}">Edit</a>
            @endif
        @endif
    </small>
@stop

@section('content')
    <h3>Description :</h3>
    <p>{{$serie->description}}</p>
    <h3>List of {{ $serie->title }}'s exercises :</h3>

    @if ( $exercises )
        @foreach ( $exercises as $ex )
            <h4><a href="../exercises/{{$ex->id}}">{{ first20chars($ex->question) }}</a></h4>
        @endforeach
    @endif
    <br>

    @if ( $serie->makerId === Auth::id() )
        <h4><a href="{{$serie->id}}/newexercise">Create a new exercise</a></h4>
        <h4><a href="{{$serie->id}}/referenceexercise">Use an existing exercise</a></h4>
    @endif
    <br><br>

    @if( unratedSeries($serie->id) )
        <h4>No ratings found for this series.</h4>
    @else
        <h4>Average rating : {{ averageRating($serie->id) }} / 5</h4>
    @endif

    @if ( Auth::check() and notRatedYet(Auth::id(), $serie->id))
        <br> <br>
        {!! Form::open(['action' => ['SeriesController@storeRating', $serie->id]]) !!}
            <div class="form-group">
                {!! Form::label('rating', 'Rate this series: ') !!}
                {!! Form::select('rating', [null => 'Select rating...', '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5']) !!}
            </div>
            <div class="form-group">
                {!! Form::hidden('sId', $serie->id) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit rating', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @endif
@stop
