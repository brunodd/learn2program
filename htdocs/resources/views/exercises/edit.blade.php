@extends('master')

@section('title')
    Edit exercise {{ ExNrOfSerie($exercise->id, $exercise->serieId) }} of <em>{{ loadSerieWithId($exercise->serieId)[0]->title }}</em>
@stop

@section('content')
    <p> For now, nothing can be updated... </p>
@include('errors.list')

@stop

