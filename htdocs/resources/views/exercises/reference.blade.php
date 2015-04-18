@extends('master')

@section('head')
    <script src="/js/skulpt.js"></script>
    <script src="/editarea/edit_area/edit_area_full.js"></script>
@stop

@section('title')
    Adding an existing exercise to series: {{ $serie->title }}
@stop

@section('content')
    <h4><a href="/exercises/copy">Copy an exisiting exercise.</a></h4>
    <p><em>(This means that you become the new and sole author of the exercise)</em></p>
    <h4><a href="/exercises/reference">Reference an existing exercise.</a></h4>
    <p><em>(This means that the you 'add' the original exercise to your series. When the original exercise gets updated (or deleted), so will this one.)</em></p>
@stop
