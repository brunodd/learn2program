@extends('master')

@section('title')
    Full list of messages.
@stop

@section('content')
<table style="width:50%">
    <tr>
        <td><h2>userA</h2></td>
        <td><h2>userB</h2>
        <td><h2>Message</h2></td>
        <td><h2>Date</h2></td>
        <td><h2>Author</h2></td>
    </tr>
    <tr>
    @foreach($messages as $message)
        <td>{{ $message->userA }}</td>
        <td>{{ $message->userB }}</td>
        <td>{{ $message->message }}</td>
        <td>{{ $message->date }}</td>
        <td>{{ $message->username }}</td>
    </tr>
    @endforeach
</table>
@stop
