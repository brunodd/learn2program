@extends('master')

@section('title')
    Edit exercise {{$exercise->id}} of <em>{{ $serie->title }}</em>
@stop

@section('content')
<p> For now, nothing can be updated... </p>
@include('errors.list')

@stop

