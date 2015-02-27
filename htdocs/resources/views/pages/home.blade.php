@extends('master')

@section('title')
    Home page
@stop

@section('content')
    <h2>Welcome to Learn2Program</h2>
    <ul>
        <a href="about"><h3>Explanation</h3></a>
        <div class="body">Some talk about the website.</div>
    </ul>
    <ul>
        <a href="login"><h3>User login</h3></a>
    </ul>
    <ul>
        <a href="/register"><h3>Create a new user</h3></a>
    </ul>
@stop
