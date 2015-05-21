@extends('master')

@section('head')
    <link rel="stylesheet" href="/bootstrap-star-rating/css/star-rating.css">
    <script src="/bootstrap-star-rating/js/star-rating.js"></script>

    <style>
        #captioner {
            float: right;
        }
    </style>
@stop

@section('title')
    <div style="float:left">
        <b><em>{{ $serie->title }}</em></b><br>
        <h4>Subject : {{$type->subject}}<br>
        Difficulty : {{$type->difficulty}}</h4>
    </div>
    @if( Auth::check() and isMakerOfSeries($serie->id, Auth::id()) )
        @if( count(loadSerieWithIdOrTitle($serie->title)) === 1 )
            <a href="{{ action('SeriesController@edit', $serie->title )}}" class="btn btn-primary"
                style="float:right; color: white;"><i class="glyphicon glyphicon-edit"></i> Edit</a>
        @else
            <a href="{{ action('SeriesController@edit', $serie->id )}}" class="btn btn-primary"
            style="float:right; color:white;"><i class="glyphicon glyphicon-edit"></i> Edit</a>
        @endif
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
    <?php $accomplishedPercentage = 0; ?>
    @if( Auth::check() )
        <?php $accomplishedPercentage = returnAccomplishedPercentageSeries(Auth::user(), $serie); ?>
    @endif
    <div class="progress">
        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{$accomplishedPercentage}}%">
                {{$accomplishedPercentage}}% Complete (success)
        </div>
        @if($accomplishedPercentage == 0)
            0% Non accomplished yet
        @endif
    </div>
    <div style="float: right;">
        @if( unratedSeries($serie->id) )
            {!! Form::open(['action' => ['SeriesController@storeRating', $serie->id]]) !!}
                {!! Form::hidden('sId', $serie->id) !!}
                <label class="control-label">Rating</label>
                <div id="captioner"></div>
                <input name="rating" id="notRatedYet" class="rating" data-min="0" data-max="5" data-step="1" data-show-clear="false" onchange="this.form.submit()"> 
            {!! Form::close() !!}
        @elseif(Auth::check() and notRatedYet(Auth::id(), $serie->id))
            {!! Form::open(['action' => ['SeriesController@storeRating', $serie->id]]) !!}
                {!! Form::hidden('sId', $serie->id) !!}
                <label class="control-label">Rating</label>
                <div id="captioner"></div>
                <input name="rating" class="rating" value=" {{ ceil(averageRating($serie->id) * 2) / 2 }}" data-min="0" data-max="5" data-step="1" data-show-clear="false" onchange="this.form.submit()">
            {!! Form::close() !!}
        @else
            <label class="control-label">Rating</label>
            <div id="captioner"></div>
            <input class="rating" value=" {{ ceil(averageRating($serie->id) * 2) / 2}}" data-min="0" data-max="5" data-step="1" data-show-clear="false" data-readonly="true">
        @endif
        <label> Views: {{ $serie->views }}  </label>
        {{ addViewToSeries($serie) }}
    </div>

    <div style="float: left; width: calc(99% - 230px);">
        <h3 style="margin-top: 0;">Description :</h3>

        <p>{{$serie->description}}</p>
    </div>
    <div style="clear: both;"></div>

    <h3>List of {{ $serie->title }}'s exercises :</h3>

    @if ( $exercises )
        @foreach ( $exercises as $ex )
            <h4><a href="/exercises/{{$ex->id}}">{{ first20chars($ex->question) }}</a></h4>
        @endforeach
    @endif
    <br>

    

    <h3>Recommended for you :</h3>
    <?php   $result = returnRecommendations($serie);
            $emptyRecommendations = true; ?>
            
    @foreach($result as $temp)
        @if ( !isEmptySeries($temp) )
            <?php $emptyRecommendations = false; ?>
            <h4><a href="/series/{{$temp->title}}/">{{ $temp->title }}</a></h4>
        @endif
    @endforeach
    @if ( $emptyRecommendations )
        <?php $recommendations = returnSeriesRandom($serie); ?>
        @foreach($recommendations as $temp)
            @if ( !isEmptySeries($temp) )
                <?php $emptyRecommendations = false; ?>
                <h4><a href="/series/{{$temp->title}}/">{{ $temp->title }}</a></h4>
            @endif
        @endforeach
    @endif

   <!-- @if ( $serie->makerId === Auth::id() )
        <hr/>
        <h4><a href="{{$serie->id}}/newexercise">Create a new exercise</a></h4>
            <p><em>(This means you create a new exercise from scratch. This is the recommended action for creating a most personalised series.)</em></p>
        <h4><a href="{{$serie->id}}/referenceexercise">Reference an existing exercise</a></h4>
            <p><em>(This means that the you 'add' the original exercise to your series. You will have no rights for altering the exercise. 
            When the original exercise gets updated (or deleted), so will this one.)</em></p>
        <h4><a href="{{$serie->id}}/copyexercise">Copy an existing exercise</a></h4>
            <p><em>(This means that you become the new and sole author of the exercise. All the changes are your own.)</em></p>
        @endif -->


    <br><br>
    <script>
        $("#notRatedYet").rating({
            clearCaption: "Not rated yet",
            captionElement: "#captioner"
        });

        $(".rating").rating({
            captionElement: "#captioner"
        });
    </script>
@stop
