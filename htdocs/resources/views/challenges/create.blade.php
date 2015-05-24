@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Challenge a friend
@stop

@section('content')
    @if(empty($friends))
        You need friends before you can challenge them.
    @else
        <div class="container">
            <div class="series ttr" id="tr1" style="padding: 5px 15px">
                <button class="sort" id="name1" data-sort="name:asc" style=" width: calc(50% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name1')">Name<span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="name2" data-sort="name:desc" hidden style=" width: calc(50% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name2')">Name<span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="score1" data-sort="score:asc" style=" width: calc(50% - 3px);" onclick="myScripts.switchDataSort('score1')">Score<span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="score2" data-sort="score:desc" hidden style=" width: calc(50% - 3px);" onclick="myScripts.switchDataSort('score2')">Score<span class="glyphicon glyphicon-triangle-top"></span></button>
            </div>

            <div class="series" id="mix-wrapper">
                @foreach($friends as $friend)
                    <div class="mix ttr" data-name="{{ $friend->username }}" data-score="{{ $friend->score }}" onclick="window.location.href='{{ action('ChallengesController@store', [$friend->username, $exId])}}';">
                        <div class="ttd" style="width: calc(50% - 3px);">{{ $friend->username }}</div>
                        <div class="ttd"  style="width: calc(50% - 3px);">{{ $friend->score }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <script>
        myScripts.initializeMixItUp();
    </script>
@stop
