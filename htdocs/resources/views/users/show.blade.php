@extends('master')

@section('title')
    <em>{{ $user->username }}'s</em> main page
    @if( Auth::check() and ($user->id == Auth::id()) )
    <br>
    <small><a href="{{ action('UsersController@edit', $user->username )}}">Edit</a></small>
    @endif
@stop

@section('content')
    This page shows whatever needs to be shown about {{ $user->username }}.
@stop
