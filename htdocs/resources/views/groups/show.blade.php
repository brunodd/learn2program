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
    <?php
        $users = listUsersOfGroup($group->id);
    ?>
@stop

@section('title')
    <em>{{ $group->name }}</em>

    @if( Auth::check() and isFounderOfGroup($group->id, Auth::id()) )
        <a href="{{ action('GroupsController@edit', $group->name )}}" class="btn btn-primary" style="color: #ffffff; float:right;">Edit</a>
    @endif
    <div style="clear: both"></div>
@stop

@section('content')

    @if ( Auth::check() and !$isMember )
        {!! Form::open(['action' => ['GroupsController@join', $group->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Join group', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @elseif ( Auth::check() )
        {!! Form::open(['action' => ['GroupsController@leave', $group->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Leave group', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @endif

    @foreach($users as $user)
        <div class="member">
            <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
            </div>
            <div class="profiledata">
                <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                <p> {{ $user->info }} </p>
            </div>
        </div>
        <div style="clear: both;"></div>
    @endforeach

@stop
