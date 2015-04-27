@extends('master')

@section('head')
    <style>
        .profileheader {
            float: left;
            padding: 5px;
        }

        .profileheader img {
            width:50px;
            height:50px;
            float:left;
            margin-right: 5px;
        }
    </style>
@stop

@section('title')
    <div class="profileheader">
        <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
        <b><em>{{ $user->username }}</em></b>
    </div>

    @if( Auth::check() and ($user->id == Auth::id()) )
        <div style="float: right;color: white;"><a href="{{ action('UsersController@edit', $user->username )}}" class="btn btn-primary">Edit</a></div>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
    <p> {{ $user->info }}</p>

    @if (Auth::check() and $user->id != Auth::id())
        <div class="form-group" >
            <a href="{{ action('MessagesController@show', $user->username )}}">
            <input class="btn btn-primary" type="submit" value="Send message"></a>
        </div>
        <br>

        @if (canSendFriendRequest($user->id))
            {!! Form::open(['action' => ['UsersController@addFriend', $user->username]]) !!}
                <div class="form-group" >
                    {!! Form::submit('Add as friend', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        @elseif (isFriendRequestPending($user->id))
            {!! Form::open(['action' => ['UsersController@acceptFriend', $user->username]]) !!}
            <div class="form-group" >
                {!! Form::submit('Accept friend request', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['action' => ['UsersController@declineFriend', $user->username]]) !!}
            <div class="form-group" >
                {!! Form::submit('Decline friend request', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        @elseif (!empty(loadFriend($user->id)))
            {!! Form::open(['action' => ['UsersController@removeFriend', $user->username]]) !!}
                <div class="form-group" >
                    {!! Form::submit('Remove friend', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        @elseif (isSentFriendRequestPending($user->id))
            <div class="form-group btn btn-primary disabled" >
                Friend request pending
            </div>
        @endif
    @endif
@stop
