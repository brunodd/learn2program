@extends('master')

@section('title')
Your challenges
@stop

@section('content')

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
@stop

