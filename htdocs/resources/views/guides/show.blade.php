@extends('master')

@section('head')

@stop

@section('title')
    <div style="float:left">
        <b><em>{{ $guide->title }}</em></b><br>
        <h4> by {{$author->username}}</h4>
    </div>

    <div style="float: right">
        @if( Auth::check() and ($author->id == Auth::id()) )
            <a href="/guides/{{ $guide->title }}/delete" class="btn btn-primary" onclick="if(!confirm('Are you sure you want to delete this guide?')){return false;}">
                <i class="glyphicon glyphicon-trash"></i> Delete
            </a>
            <a href="{{ action('GuidesController@edit', $guide->title )}}" class="btn btn-primary">
                <i class="glyphicon glyphicon-edit"></i> Edit
            </a>
        @endif
    </div>
    <div style="clear: both;"></div>
@stop

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        {!! $guide->content !!}
    </div>
@stop
