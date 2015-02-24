@extends('master')

@section('title')
    Series home page
@stop

@section('content')
    <h2>List of all series:</h2>

    @foreach($series as $serie)
        <h3>{{$serie->title}}</h3>
        <p>{{$serie->description}}</p>
    @endforeach

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="serie/create">Create new serie</a></h2>
    <h2><a href="../user/create">Registration page</a></h2>
@stop
