@extends('master')

@section('title')
    Send Notification
@stop

@section('content')

            <h3>FRIENDS:</h3>
            @if(empty($user_options))
            	Make some new friends so you can share all your hard work!
            @endif
            @foreach($user_options as $user)
            	<a href="{{ action('NotificationsController@shareNotification', [$user->id])}}">{{$user->username}}</a><br>
            @endforeach


@stop