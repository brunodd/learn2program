@extends('master')

@section('title')
    <h1> <em>{{ $serie->title }}'s</em> main page </h1>
@stop

@section('content')
    This page should show a list of {{ $serie->title }}'s exercises or something like that...
@stop
