@extends('master')

@section('title')
    <h1>Series home page</h1>
@stop

@section('content')
    <h2>List of all series:</h2>
    <p>Will become available soon</p>
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="serie/create">Create new serie</a></h2>
    <h2><a href="../user/create">Registration page</a></h2>
@stop
