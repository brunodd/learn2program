@extends('master')

@section('title')
    Leaderboard  
@stop

@section('content')
<table style="width:100%;">
 <tr>
    <td style="width:50%;text-align: left;"><h3>Users:</h3></td>
    <td style="width:50%;text-align: left; position:relative; right:35px; top:10px;"><h3>Score:</h3></td>
  </tr>
</table>
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
