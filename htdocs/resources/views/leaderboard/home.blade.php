@extends('master')

@section('head')
    <style>
        .member {
            width: 100%;
            height: 60px;
            padding: 5px;
            margin-bottom: 10px;
            border-bottom: solid 1px #9d9c9b;
        }

        .profilepic {
            width:50px;
            height:50px;
            float:left;
            margin-right: 5px;
        }

        .profilepic img {
            width:50px;
            height:50px;
        }

        .profilepic img:hover {
            cursor: pointer;
        }

        .profiledata {
            float: right;
            direction: ltr;
            width: calc(100% - 55px);
        }

        .profiledata a {
            font-weight: bold;
        }
    </style>
@stop

@section('title')
    Leaderbord  
@stop

@section('content')
        <h3>Users: <center>Score:</center></h3>
        <?php $templist = loadUsersRanked() ?>
        @foreach($templist as $user)
            <div class="member">
                <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                    <img src="images/users/{{ $user->image }}" alt="Profile Picture">
                </div>
                <div class="profiledata">
                    <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                    <center><h4>{{ loadAllAccomplishedExercises($user) }}</h4></center>
                </div>
            </div>
            <div style="clear: both;"></div>
        @endforeach
        <?php $templist2 = loadUsersNotRanked() ?>
        @foreach($templist2 as $user)
            <div class="member">
                <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                    <img src="images/users/{{ $user->image }}" alt="Profile Picture">
                </div>
                <div class="profiledata">
                    <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                    <center><h4>0</h4></center>
                </div>
            </div>
            <div style="clear: both;"></div>
        @endforeach
@stop
