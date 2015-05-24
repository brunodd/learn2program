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
Exercise: <a href="/exercises/{{$challenge->exId}}" style="font-style: italic; color: #ffffff">{{ firstChars(strip_tags(loadExercise($challenge->exId)[0]->question), 50) }}</a> <br/>
<a href="/users/{{ $userA->username }}"  style="color: #ffffff">{{ $userA->username }}</a>
<i>vs</i>
<a href="/users/{{ $userB->username }}"  style="color: #ffffff">{{ $userB->username }}</a>
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

