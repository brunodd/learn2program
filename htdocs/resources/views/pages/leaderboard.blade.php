@extends('master')

@section('title')
    Leaderbord  
@stop

@section('content')
        <h3>Users: <center>Score:</center></h3>

        @foreach($usersRanked as $user)
            <div class="user">
                <div class="userimage" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                    <img src="images/users/{{ $user->image }}" alt="Profile Picture">
                </div>
                <div class="userdata">
                    <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                    <center><h4>{{ loadAllAccomplishedExercises($user) }}</h4></center>
                </div>
            </div>
            <div style="clear: both;"></div>
        @endforeach

        @foreach($usersUnranked as $user)
            <div class="user">
                <div class="userimage" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                    <img src="images/users/{{ $user->image }}" alt="Profile Picture">
                </div>
                <div class="userdata">
                    <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                    <center><h4>0</h4></center>
                </div>
            </div>
            <div style="clear: both;"></div>
        @endforeach
@stop
