@extends('master')

@section('head')
<?php
    $user = loadUser(\Auth::id())[0];
    $friends = loadMeAndFriends();
?>
@stop

@section('title')
Your challenges
<u><h4>Current score: {{ $user->score }} </h4></u>
@stop

@section('content')
<div class="row" style="height: 100%;width: 100%">
<div class="col-md-3" style="height: 100%;">
    <div class="jumbotron" style="padding: 10px 35px;max-height: 60%;overflow-y: auto;position: fixed;"><h4 style="text-align: center;">Ranking</h4>
        <?php $index = 0; ?>
        @foreach($friends as $f)
            <?php $index += 1; ?>
            <div class="row">
                @if($f->id == $user->id)
                    <font color="white"><em><b>{{ $index }}. {{$f->username }} ({{ $f->score }})</b></em></font>
                @else
                    <a href="/users/{{ $f->username }}"><font color="white"><em>{{ $index }}. {{$f->username }} ({{ $f->score }})</em></font></a>
                @endif
            </div>
        @endforeach
    </div>
</div>
<div class=col-md-7>
@if(empty($challengesA) && empty($challengesB))
    No one challenged you so far!
@else
    <h3> Challenges to win! </h3>
    <ul>
    @foreach($challengesA as $challenge)
        {{-- Get opponent --}}
        @if ( $challenge->userA == \Auth::id() )
            <?php $name = loadUser($challenge->userB)[0]->username; ?>
        @else
            <?php $name = loadUser($challenge->userA)[0]->username; ?>
        @endif
        <li><a href="/exercises/{{$challenge->exId}}">Exercise {{ firstChars(strip_tags(loadExercise($challenge->exId)[0]->question), 20) }} </a></br>
            <div style="text-indent: 2em"><a href="/challenges/{{$challenge->id}}"><em>(vs {{ $name }} )</em></a></div>
    @endforeach
    </ul>
    <h3> Challenges you won </h3>
    <ul>
    @foreach($challengesB as $challenge)
        {{-- Get opponent --}}
        @if ( $challenge->userA == \Auth::id() )
            <?php $name = loadUser($challenge->userB)[0]->username; ?>
        @else
            <?php $name = loadUser($challenge->userA)[0]->username; ?>
        @endif
        <li><a href="/exercises/{{$challenge->exId}}">Exercise {{ firstChars(strip_tags(loadExercise($challenge->exId)[0]->question), 20) }} </a></br>
            <div style="text-indent: 2em"><a href="/challenges/{{$challenge->id}}"><em>(vs {{ $name }} )</em></a></div>
    @endforeach
    </ul>
@endif
</div>
</div>
@stop

