@extends('master')

@section('title')
    Welcome to Learn2Program
@stop


@section('head')
    <style>
        .jumbotron a {
            width: 200px;
        }
    </style>
    <link href="/css/web/style2.css" rel="stylesheet" type="text/css" media="all" />

@stop

@section('content')
@include('web.homepagebody')
@stop

<!--


@section('content')
<<<<<<< HEAD
    <h2>Welcome to Learn2Program</h2>

    <ul>
        <a href="about"><h3>Explanation</h3></a>
        <div class="body">Some talk about the website.</div>
    </ul>

    @if ( !Auth::check() )
        <ul>
            <a href="login"><h3>User login</h3></a>
        </ul>
        <ul>
            <a href="/register"><h3>Create a new user</h3></a>
        </ul>
    @endif
@stop-->
<!--
    <div class="container">
        <div class="jumbotron">
            <h1>Learn python online</h1>
            <p class="lead">Start off by learning python, with support for more languages coming soon!</p>
            <div class="text-center">
                <a class="btn btn-lg btn-success" href="/login" role="button">Start learning now</a>
            </div>
            <div style="clear: both"></div>
        </div>

        <h2>Members can:</h2>
        <div class="row marketing">
            <div class="col-lg-6">
                <li><h4>Solve and create exercises</h4><br></li>

                <li><h4>Make series of exercises</h4><br></li>

                <li><h4>Form groups</h4></li>
            </div>

            <div class="col-lg-6">
                <li><h4>Make friends</h4><br></li>

                <li><h4>Check out graphs</h4><br></li>

                <li><h4>Blabla</h4></li>
            </div>
        </div>
    </div>
@stop
