@extends('master')

@section('title')
    Full list of users (containing passwords).
@stop

@section('content')
<table style="width:50%">
    <tr>
        <td><h2>ID</h2></td>
        <td><h2>Username</h2>
        <td><h2>Password</h2></td>
        <td><h2>E-mail</h2></td>
    </tr>
    <tr>
    @foreach($users as $user)
        <td>"{{ $user->id }}"</td>
        <td>"{{ $user->username }}"</td>
        <td>"{{ $user->pass }}"</td>
        <td>"{{ $user->mail }}"</td>
    </tr>
    @endforeach
</table>
@stop