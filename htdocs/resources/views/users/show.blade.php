@extends('master')

@section('title')
    <em>{{ $user->username }}'s</em> main page
@stop

@section('content')
    This page shows whatever needs to be shown about {{ $user->username }}.
@stop
