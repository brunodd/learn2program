@extends('master')

@section('title')
    <em>{{ $group->name }}'s</em> main page <br>
    <small><a href="{{ action('GroupsController@edit', $group->name )}}">Edit</a></small>
@stop

@section('content')
    This page should show a list of {{ $group->name }}'s members or something like that...
    @if ( Auth::check() and !$isMember )
    {!! Form::open() !!}
        <div>
        {!! Form::submit('Join group', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    @elseif ( Auth::check() )
    {!! Form::open(['method' => 'PATCH']) !!}
        <div>
        {!! Form::submit('Leave group', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    @endif
@stop
