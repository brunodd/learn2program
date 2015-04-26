@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Your Series
@stop

@section('content')
    <div class="container">
        <h4>Filter on</h4>

        <div class="options">
            <button class="filter" data-filter="all">All</button>
            <button class="filter" data-filter=".Easy">Easy</button>
            <button class="filter" data-filter=".Intermediate">Intermediate</button>
            <button class="filter" data-filter=".Hard">Hard</button>
            <button class="filter" data-filter=".Insane">Insane</button>
        </div>
        <div style="clear: both"></div>

        <h4>Sort by</h4>

        <div class="options">
            <button class="sort" id="title1" data-sort="title:asc" onclick="myScripts.switchDataSort('title1')">Title</button>
            <button class="sort" id="title2" data-sort="title:desc" hidden onclick="myScripts.switchDataSort('title2')">Title</button>
            <button class="sort" id="rating1" data-sort="rating:asc" onclick="myScripts.switchDataSort('rating1')">Rating</button>
            <button class="sort" id="rating2" data-sort="rating:desc" hidden onclick="myScripts.switchDataSort('rating2')">Rating</button>
            <button class="sort" id="subject1" data-sort="subject:asc" onclick="myScripts.switchDataSort('subject1')">Subject</button>
            <button class="sort" id="subject2" data-sort="subject:desc" hidden onclick="myScripts.switchDataSort('subject2')">Subject</button>
            <button class="sort" id="difficulty1" data-sort="difficulty:asc" onclick="myScripts.switchDataSort('difficulty1')">Difficulty</button>
            <button class="sort" id="difficulty2" data-sort="difficulty:desc" hidden onclick="myScripts.switchDataSort('difficulty2')">Difficulty</button>
            <button class="sort" data-sort="random">Random</button>
        </div>
        <div style="clear: both"></div>

        <div class="series" id="mix-wrapper">
            <div class="ttr" id="tr1">
                <div class="ttd">Title</div>
                <div class="ttd dd">Rating</div>
                <div class="ttd dd">Subject</div>
                <div class="ttd dd">Difficulty</div>
            </div>
            @foreach($series as $serie)
                @if( SerieContainsExercises($serie->id) || isMakerOfSeries($serie->id, Auth::id()) )
                    <div class="mix ttr {{ loadType2($serie->tId)[0]->difficulty }}" data-title="{{$serie->title}}" data-rating="{{ loadRatingAsInt($serie->id) }}" data-subject="{{ loadType2($serie->tId)[0]->subject }}" data-difficulty="{{ loadDifficultyAsInt($serie->tId) }}" onclick="window.location.href='/series/{{$serie->title}}';">
                        <div class="ttd">{{$serie->title}}</div>
                        <div class="ttd dd">{{ averageRating($serie->id) }}</div>
                        <div class="ttd dd">{{ loadType2($serie->tId)[0]->subject }}</div>
                        <div class="ttd dd">{{ loadType2($serie->tId)[0]->difficulty }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        myScripts.initializeMixItUp();
    </script>

    <div style="height: 50px;"></div>
    <h3><a href="series/create">Create new series</a></h3>
@stop
