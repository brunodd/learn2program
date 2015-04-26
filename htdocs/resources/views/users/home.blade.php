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
    All members
@stop

@section('content')
        @foreach($users as $user)
            <div class="member">
                <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                    <img src="images/users/{{ $user->image }}" alt="Profile Picture">
                </div>
                <div class="profiledata">
                    <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                    <p>Some info about user: e.g. completed x series/has rating y</p>
                </div>
            </div>
            <div style="clear: both;"></div>
        @endforeach
@stop
