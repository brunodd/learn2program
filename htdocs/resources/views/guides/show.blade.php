@extends('master')

@section('head')

@stop

@section('title')
    <div style="float:left">
        <b><em>{{ $guide->title }}</em></b><br>
        <h4> by {{$author->username}}</h4>
    </div>
    @if( Auth::check() and ($author->id == Auth::id()) )
    <a href="/guides/{{ $guide->title }}/delete"
        class="btn btn-primary" style="float:right; color: red;"
        onclick="if(!confirm('Are you sure you want to delete this guide?')){return false;};">
        <i class="glyphicon glyphicon-trash"></i> Delete</a>
    <a href="{{ action('GuidesController@edit', $guide->title )}}"
        class="btn btn-primary" style="float:right; color: white;">
        <i class="glyphicon glyphicon-edit"></i> Edit</a>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
 <div class="container col-md-8 col-md-offset-2">
{!! $guide->content !!}
</div>

@stop
