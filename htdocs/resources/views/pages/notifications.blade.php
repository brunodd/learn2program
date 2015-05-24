@extends('master')

@section('title')
    Your Notifications
@stop

@section('content')
    <ul>
        @foreach($notifications as $notification)
            <h4>{!! $notification->message !!}</h4>
        @endforeach
    </ul>
@stop