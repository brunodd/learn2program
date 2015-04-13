@extends('master')

@section('title')
    Edit exercise {{ ExNrOfSerie($exercise->id, $exercise->seriesId) }} of <em>{{ loadSerieWithId($exercise->seriesId)[0]->title }}</em>
@stop

@section('content')
    <p> For now, nothing can be updated... </p>
@include('errors.list')

@stop

