@extends('master')

@section('head')

@stop

@section('title')
    <div style="float:left">
        <b><em>{{ $guide->title }}</em></b><br>
        <h4> by {{$author->username}}</h4>
    </div>
    @if( Auth::check() and ($author->id == Auth::id()) )
    <a href="{{ action('GuidesController@edit', $guide->title )}}" class="btn btn-primary" style="float:right; color: white;">Edit</a>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')

{!! $guide->content !!}

@stop
