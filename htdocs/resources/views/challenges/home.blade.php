@extends('master')

@section('title')
Your challenges
<?php $user = loadUser(\Auth::id())[0] ?>
<u><h4>Current score: {{ $user->score }} </h4></u>
@stop

@section('content')
<div class="col-md-3" style="height: 100%;">
    <div class="jumbotron" style="padding: 10px 35px;max-height: 60%;overflow-y: auto;position: fixed;"><h4 style="text-align: center;">Ranking</h4>
        <div class="row">
            Here comes a list of all your friends, </br>
            order based on their current score.
        </div>
    </div>
</div>
<div class=col-md-7>
@if(empty($challengesA) && empty($challengesB))
    No one dares challenge you!
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
        <li><a href="/challenges/{{$challenge->id}}">Exercise {{ $challenge->exId }} vs {{ $name }}.</a>
            <u><a href="/exercises/{{$challenge->exId}}">Do this!</a></u></li>
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
        <li><a href="/challenges/{{$challenge->id}}">Exercise {{ $challenge->exId }} vs {{ $name }}.</a>
            <u><a href="/exercises/{{$challenge->exId}}">Improve your time!</a></u></li>
    @endforeach
    </ul>
@endif
</div>
@stop

