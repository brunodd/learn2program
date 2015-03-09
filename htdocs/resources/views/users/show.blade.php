@extends('master')

@section('title')
    <em>{{ $user->username }}'s</em> main page
    @if( Auth::check() and ($user->id == Auth::id()) )
    <br>
    <small><a href="{{ action('UsersController@edit', $user->username )}}">Edit</a></small>
    @endif
@stop

@section('content')
    This page shows whatever needs to be shown about {{ $user->username }}.

    @if (Auth::check())
        @if ($user->id == Auth::id())
        @else
            <div>
                <a href="{{ action('MessagesController@show', $user->username )}}"><input class="btn btn-primary" type="submit" value="Send message"></a>
            </div>
            @if (!findFriends($user->id, Auth::id()))
                {!! Form::open() !!}
                <div>
                    {!! Form::submit('Add as friend', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(['method' => 'PATCH']) !!}
                <div>
                    {!! Form::submit('Remove friend', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            @endif
        @endif
    @endif
@stop
