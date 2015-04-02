@extends('master')

@section('title')
    Full list of users.
@stop

@section('content')
    <table style="width:100%">
        <tr>
            <td><h2>ID</h2></td>
            <td><h2>Username</h2>
            <td><h2>Password</h2></td>
            <td><h2>E-mail</h2></td>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ action('UsersController@show', [$user->username])}}">{{ $user->username }}</a></td>
                <td>{{ $user->pass }}</td>
                <td>{{ $user->mail }}</td>
            </tr>
        @endforeach
    </table>
@stop
