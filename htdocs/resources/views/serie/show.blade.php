@extends('master')

@section('title')
    <em>{{ $serie->title }}'s</em> main page
@stop

@section('content')
    This page should show a list of {{ $serie->title }}'s exercises or something like that...
@stop
