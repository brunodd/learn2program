@extends('master')

@section('title')
    Send Notification
@stop

@section('content')

            <h3>FRIENDS:</h3>
            @if(empty($user_options))
                You need friends before you can challenge them.
            @endif
            @foreach($user_options as $user)
            	<a href="{{ action('NotificationsController@sendChallengeNotification', [$user->id])}}">{{$user->username}}</a><br>
            @endforeach


@stop
