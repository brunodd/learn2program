@extends('master')

@section('title')
    <h1>Groups home page</h1>
@stop

@section('content')
    <h2>List of all groups:</h2>

    @foreach($groups as $group)
        <h3>{{$group->name}}</h3>
        <p>List of members</p>
    @endforeach

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <h2><a href="groups/create">Create new group</a></h2>
    <h2><a href="../users/create">Registration page</a></h2>
@stop
