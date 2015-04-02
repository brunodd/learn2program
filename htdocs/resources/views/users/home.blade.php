@extends('master')

@section('title')
    Users home page
@stop

@section('content')
    <h2>List of all users:</h2>

    <ul>
        @foreach($users as $user)
            <img src="images/users/user{{ $user->id }}ProfilePicture.jpg" alt="Profile Picture" style="max-width:50px;max-height:50px;float:left;padding: 0 5px 0 0;">
            <h3>
                <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
            </h3>
            <small>Some info about user: e.g. completed x series/has rating y</small>
            <hr>
        @endforeach
    </ul>
@stop
