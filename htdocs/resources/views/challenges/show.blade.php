@extends('master')

@section('title')
<?php
    $userA = loadUser($challenge->userA)[0];
    $userB = loadUser($challenge->userB)[0];
    $winner = [];
    $loser = [];
    if($challenge->winner == $userA->id) {
        $winner = $userA;
        $loser = $userB;
    }
    else if ($challenge->winner == $userB->id) {
        $winner = $userB;
        $loser = $userA;
    }
?>
<u><a href="/exercises/{{$challenge->exId}}"><font color="white">Exercise {{ loadExercise($challenge->exId)[0]->question }}</font></a></u>: </br>
    <a href="/users/{{ $userA->username }}"><font color="white">{{ $userA->username }}</font></a> vs <a href="/users/{{ $userB->username }}"><font color="white">{{ $userB->username }}</font></a>
@stop

@section('content')
<div>
    @if ($winner == [])
        <h2> Tie </h2>

    @else
    <div>
        <a href="/users/{{ $winner->username }}"><h2> Winner: {{ $winner->username }} </h2></a>
        ({{ loadCorrectAnswers($winner->id, $challenge->exId)[0]->time }} seconds)
    </div>
    <div>
        <a href="/users/{{ $loser->username }}"><h3> Loser: {{ $loser->username }} </h3></a>
            @if(empty(loadCorrectAnswers($loser->id, $challenge->exId)))
                (not tried yet)
            @else
                ({{ loadCorrectAnswers($loser->id, $challenge->exId)[0]->time }} seconds)
            @endif
    </div>
    @endif
</div>

@stop

