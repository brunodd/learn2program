@extends('master')

@section('title')
    Users home page
@stop

@section('content')
    <h2>List of all users:</h2>

    <ul>
        @foreach($users as $user)
                <h3>*avatar/picture* <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a></h3>
                <i>Some info about user: e.g. completed x series/has rating y</i>
        @endforeach
    </ul>
@stop
