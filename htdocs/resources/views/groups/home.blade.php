@extends('master')

@section('title')
    Groups home page
@stop

@section('content')
    <h2>List of all groups:</h2>

    <ul>
        @foreach($groups as $group)
            <h3><a href="{{ action('GroupsController@show', [$group->id])}}">{{$group->name}}</a></h3>
            <p>Founder : <a href="{{ action('UsersController@show', [$group->founderId])}}">{{ loadUser($group->founderId)[0]->username }}</a></p>
            <p>List of members</p>
        @endforeach
    </ul>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="groups/create">Create new group</a></h2>
    <h2><a href="/register">Registration page</a></h2>
@stop
