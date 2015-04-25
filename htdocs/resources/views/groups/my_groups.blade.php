@extends('master')

@section('title')
    Your Groups
@stop

@section('content')
    <h2>List of all groups:</h2>

    @foreach($groups as $group)
        <h3><a href="{{ action('GroupsController@show', [$group->name])}}">{{$group->name}}</a></h3>
    @endforeach

    <div style="height: 50px"></div>
    <h5><a href="groups/create">Create new group</a></h5>

    @include('errors.list')
@stop
