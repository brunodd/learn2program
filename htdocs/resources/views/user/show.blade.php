@extends('master')

@section('title')
    <h1> <em>{{ $user->username }}'s</em> main page </h1>
@stop

@section('content')
    This page shows whatever needs to be shown about {{ $user->username }}.
@stop
