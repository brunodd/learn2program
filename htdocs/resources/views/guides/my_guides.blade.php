@extends('master')

@section('head')

@stop

@section('title')
    Your Guides
@stop

@section('content')
    @foreach( $guides as $guide )
    <h3><a href="/guides/{{$guide->title}}">{{ $guide->title }}</a></h3>
    @endforeach
    <h3><a href="guides/create">Create a new guide</a></h3>
@stop
