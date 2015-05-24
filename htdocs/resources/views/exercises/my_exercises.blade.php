@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Your exercises
@stop

@section('content')
    <div class="container" style="margin-bottom: 0; background: none">
        <div class="h44">Filter on</div>

        <div class="options">
            <button class="filter" style="width: calc(33% - 12px);" data-filter="all">All Languages</button>
            <button class="filter" style="width: calc(33% - 12px);" data-filter=".python">Python</button>
            <button class="filter" style="width: calc(33% - 12px);" data-filter=".cpp">C++</button>
        </div>
        <div style="clear: both"></div>
    </div>

    <div class="container">
        <div class="series ttr" id="tr1" style="padding: 5px 15px">
            <button class="sort" id="question1" data-sort="question:asc" style=" width: calc(80% - 3px); text-align: left;" onclick="myScripts.switchDataSort('question1')">Question<span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="question2" data-sort="question:desc" hidden style=" width: calc(80% - 3px); text-align: left;" onclick="myScripts.switchDataSort('question2')">Question<span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="sort" id="language1" data-sort="language:asc" style=" width: calc(20% - 3px);" onclick="myScripts.switchDataSort('language1')">Language<span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="language2" data-sort="language:desc" hidden style=" width: calc(20% - 3px);" onclick="myScripts.switchDataSort('language2')">Language<span class="glyphicon glyphicon-triangle-top"></span></button>
        </div>

        <div class="series" id="mix-wrapper">
            @foreach($exercises as $ex)
                <div class="mix ttr {{ $ex->language }}" data-question="{{ strip_tags($ex->question) }}" data-language="{{ $ex->language }}" onclick="window.location.href='{{ action('ExercisesController@show', [$ex->id])}}';">
                    <div class="ttd" style="width: calc(80% - 3px);">{{ strip_tags($ex->question) }}</div>
                    <div class="ttd dd"  style="width: calc(20% - 3px);">{{ DisplayLanguage($ex->language) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $('#mix-wrapper').mixItUp({
            animation: {
                effects: 'fade',
                duration: 300
            },
            callbacks: {
                onMixEnd: function(state) {
                    console.log(state)
                }
            },
            controls: {
                activeClass: 'derp'
            },
            layout: {
                display: 'block'
            }
        });
    </script>
@stop
