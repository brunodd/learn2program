@extends('master')

@section('title')
    Your Notifications
@stop

@section('content')
    <ul>
        @foreach($notifications as $notification)
            <h3>{!! $notification->message !!}</h3>
        @endforeach
    </ul>
@stop