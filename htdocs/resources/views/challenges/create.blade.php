@extends('master')

@section('title')
Challenge a friend
@stop

@section('content')

@if(empty($friends))
    You need friends before you can challenge them.
@endif
@foreach($friends as $friend)
    <a href="{{ action('ChallengesController@store', [$friend->username, $exId])}}">{{$friend->username}}</a><br>
@endforeach

@stop
