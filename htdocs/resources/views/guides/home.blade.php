@extends('master')

@section('head')

@stop

@section('title')
    Guides
@stop

@section('content')

    @foreach( $guides as $guide )
    <h2><a href="/guides/{{$guide->title}}">{{ $guide->title }}</a></h2>
    @endforeach

    @if ( Auth::check() )
        <h2><a href="/guides/create">Create a new guide</a></h2>
    @endif

@stop
