@extends('master')

@section('title')
    Error
@stop
@section('content')
    <h2>{{ $msg }}</h2>
    <script>alert('{{ $alert }}');</script>

    <em><a href='/'>Home</em>
@stop
