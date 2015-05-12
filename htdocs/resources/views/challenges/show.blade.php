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
<u><a href="/exercises/{{$challenge->exId}}"><font color="white">Exercise {{ $challenge->exId }}</font></a></u>: {{ $userA->username }} vs {{ $userB->username }}
@stop

@section('content')
<div>
    @if ($winner == [])
        <h2> Tie </h2>

    @else
    <div>
        <h2> Winner: {{ $winner->username }} </h2>
        ({{ loadAnswers($winner->id, $challenge->exId)[0]->time }} seconds)
    </div>
    <div>
        <h3> Loser: {{ $loser->username }} </h3>
            @if(empty(loadAnswers($loser->id, $challenge->exId)))
                (not tried yet)
            @else
                ({{ loadAnswers($loser->id, $challenge->exId)[0]->time }} seconds)
            @endif
    </div>
    @endif
</div>

@stop

