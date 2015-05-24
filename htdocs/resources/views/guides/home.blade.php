@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Guides
@stop

@section('content')

    <div class="container">

        <div class="series ttr" id="tr1" style="padding-top: 5px">
            <button class="sort" id="title1" style="width: calc(50% - 3px); text-align: center" data-sort="title:asc" onclick="myScripts.switchDataSort('title1')">Title <span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="title2" style="width: calc(50% - 3px); text-align: center" data-sort="title:desc" hidden onclick="myScripts.switchDataSort('title2')">Title <span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="sort" id="author1" style="width: calc(50% - 3px); text-align: center" data-sort="author:asc" onclick="myScripts.switchDataSort('author1')">Author <span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="author2" style="width: calc(50% - 3px); text-align: center" data-sort="author:desc" hidden onclick="myScripts.switchDataSort('author2')">Author <span class="glyphicon glyphicon-triangle-top"></span></button>
        </div>

        <div class="series" id="mix-wrapper">
            @foreach($guides as $guide)
            <div class="mix ttr {{ $guide->title }}" 
                        data-title="{{$guide->title}}" data-author="{{ loadUser($guide->writerId)[0]->username }}"
                        onclick="window.location.href='/guides/{{$guide->id}}';">
                <div class="ttd" style="width: calc(50% - 3px); text-align: center">{{$guide->title}}</div>
                <div class="ttd dd" style="width: calc(50% - 3px); text-align: center">{{ loadUser($guide->writerId)[0]->username }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        myScripts.initializeMixItUp();
    </script>

    @if ( Auth::check() )
        <h2><a href="/guides/create">Create a new guide</a></h2>
    @endif

@stop
