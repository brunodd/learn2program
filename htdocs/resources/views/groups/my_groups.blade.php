@extends('master')

@section('title')
    Your Groups
@stop

@section('content')
    <ul>
        @foreach($groups as $group)
            <h3><a href="{{ action('GroupsController@show', [$group->name])}}">{{$group->name}}</a></h3>
        @endforeach
    </ul>

    <div style="height: 50px"></div>
    <h3><a href="groups/create">Create new group</a></h3>

    @include('errors.list')
@stop
