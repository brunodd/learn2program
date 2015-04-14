@extends('master')

@section('title')
    <em>{{ $group->name }}'s</em> main page

    @if( Auth::check() and isFounderOfGroup($group->id, Auth::id()) )
        <br>
        <small><a href="{{ action('GroupsController@edit', $group->name )}}">Edit</a></small>
    @endif
@stop

@section('content')
    This page should show a list of {{ $group->name }}'s members or something like that...

    @if ( Auth::check() and !$isMember )
        {!! Form::open(['action' => ['GroupsController@join', $group->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Join group', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @elseif ( Auth::check() )
        {!! Form::open(['action' => ['GroupsController@leave', $group->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Leave group', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @endif
@stop