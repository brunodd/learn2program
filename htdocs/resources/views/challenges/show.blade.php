@extends('master')

@section('title')
<?php
    $userA = loadUser($challenge->userA)[0];
    $userB = loadUser($challenge->userB)[0];
?>
Exercise {{ $challenge->exId }}: {{ $userA->username }} vs {{ $userB->username }}
@stop

@section('content')
@if ($challenge->winner != NULL)
<h2> Winner: {{ loadUser($challenge->winner)[0]->username }} </h2>
@else
<h2> Tie </h2>
@endif

<u><a href="/exercises/{{$challenge->exId}}">Complete exercise</a></u>

@stop

