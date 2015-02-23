@extends('master')

@section('title')
    <h1>Error</h1>
@stop
@section('content')
    <h2>{{ $msg }}</h2>
    <script>alert('{{ $alert }}');</script>

    <em><a href='/'>Home</em>
@stop
