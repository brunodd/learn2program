@extends('master')

@section('title')
    <h1> <em>{{ $group->name }}'s</em> main page </h1>
@stop

@section('content')
    This page should show a list of {{ $group->name }}'s exercises or something like that...
@stop
