@extends('master')

@section('title')
    Groups home page
@stop

@section('content')
    <h2>List of all groups:</h2>

    <ul>
        @foreach($groups as $group)
            <h3><a href="{{ action('GroupsController@show', [$group->name])}}">{{ $group->name }}</a></h3>
            <p>
                Founder : <a href="{{ action('UsersController@show', loadUser($group->founderId)[0]->username)}}">{{ loadUser($group->founderId)[0]->username }}</a> <br>
                List of members
            </p>
        @endforeach
    </ul>

    @if( Auth::check() )
        <h2><a href="groups/create">Create new group</a></h2>
    @else
        <h2><a href="/login">User login</a></h2>
    @endif

    @include('errors.list')
@stop
