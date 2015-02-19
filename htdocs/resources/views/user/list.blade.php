@extends('master')

@section('title')
    <h1>Full list of users (containing passwords).</h1>
@stop

@section('content')
<table style="width:50%">
    <tr>
        <td><h2>ID</h2></td>
        <td><h2>Username</h2>
        <td><h2>Password</h2></td>
    </tr>
    <tr>
    @foreach($users as $user)
        <td>"{{ $user->id }}"</td>
        <td>"{{ $user->username }}"</td>
        <td>"{{ $user->pass }}"</td>
    </tr>
    @endforeach
</table>
@stop
