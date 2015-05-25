@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Search results for '{{ $s }}'
@stop

@section('content')
    <h2>Series</h2><hr>
    @if(!empty($series))
        <div class="container" style="margin-bottom: 0; background: none">
            <div class="h44">Filter on</div>

            <div class="options">
                <button class="filter" data-filter="all">All</button>
                <button class="filter" data-filter=".Easy">Easy</button>
                <button class="filter" data-filter=".Intermediate">Intermediate</button>
                <button class="filter" data-filter=".Hard">Hard</button>
                <button class="filter" data-filter=".Insane">Insane</button>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="container">
            <div class="series ttr" id="tr1" style="padding-top: 5px">
                <button class="sort" id="title1" data-sort="title:asc" onclick="myScripts.switchDataSort('title1')">Title <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="title2" data-sort="title:desc" hidden onclick="myScripts.switchDataSort('title2')">Title <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="rating1" data-sort="rating:asc" onclick="myScripts.switchDataSort('rating1')">Rating <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="rating2" data-sort="rating:desc" hidden onclick="myScripts.switchDataSort('rating2')">Rating <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="subject1" data-sort="subject:asc" onclick="myScripts.switchDataSort('subject1')">Subject <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="subject2" data-sort="subject:desc" hidden onclick="myScripts.switchDataSort('subject2')">Subject <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="difficulty1" data-sort="difficulty:asc" onclick="myScripts.switchDataSort('difficulty1')">Difficulty <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="difficulty2" data-sort="difficulty:desc" hidden onclick="myScripts.switchDataSort('difficulty2')">Difficulty <span class="glyphicon glyphicon-triangle-top"></span></button>
            </div>

            <div class="series" id="mix-wrapper">
                @foreach($series as $serie)
                    @if( SerieContainsExercises($serie->id) || isMakerOfSeries($serie->id, Auth::id()) )
                        <div class="mix ttr {{ loadType2($serie->tId)[0]->difficulty }}" data-title="{{$serie->title}}" data-rating="{{ loadRatingAsInt($serie->id) }}" data-subject="{{ loadType2($serie->tId)[0]->subject }}" data-difficulty="{{ loadDifficultyAsInt($serie->tId) }}" onclick="window.location.href='/series/{{$serie->id}}';">
                            <div class="ttd">{{$serie->title}}</div>
                            <div class="ttd dd">{{ averageRating($serie->id) }}</div>
                            <div class="ttd dd">{{ loadType2($serie->tId)[0]->subject }}</div>
                            <div class="ttd dd">{{ loadType2($serie->tId)[0]->difficulty }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <h2>Exercises</h2><hr>
    @if($exercises)
        <div class="container">
            <div class="series ttr" id="tr1" style="padding: 5px 15px">
                <button class="sort" id="question1" data-sort="question:asc" style=" width: calc(80% - 3px); text-align: left;" onclick="myScripts.switchDataSort('question1')">Question<span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="question2" data-sort="question:desc" hidden style=" width: calc(80% - 3px); text-align: left;" onclick="myScripts.switchDataSort('question2')">Question<span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="language1" data-sort="language:asc" style=" width: calc(20% - 3px);" onclick="myScripts.switchDataSort('language1')">Language<span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="language2" data-sort="language:desc" hidden style=" width: calc(20% - 3px);" onclick="myScripts.switchDataSort('language2')">Language<span class="glyphicon glyphicon-triangle-top"></span></button>
            </div>

            <div class="series" id="mix-wrapper2">
                @foreach($exercises as $ex)
                    <div class="mix ttr {{ $ex->language }}" data-question="{{ strip_tags($ex->question) }}" data-language="{{ $ex->language }}" onclick="window.location.href='{{ action('ExercisesController@show', [$ex->id])}}';">
                        <div class="ttd" style="width: calc(80% - 3px);">{{ strip_tags($ex->question) }}</div>
                        <div class="ttd dd"  style="width: calc(20% - 3px);">{{ DisplayLanguage($ex->language) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <h2>Groups</h2><hr>
    @if($groups)
        <div class="container">
            <div class="series ttr" id="tr1" style="padding: 5px 15px">
                <button class="sort" id="name1" data-sort="name:asc" style=" width: calc(33.3333333% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name1')">Name <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="name2" data-sort="name:desc" hidden style=" width: calc(33.3333333% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name2')">Name <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="founder1" data-sort="founder:asc" style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('founder1')">Founder <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="founder2" data-sort="founder:desc" hidden style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('founder2')">Founder <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="memberc1" data-sort="memberc:asc" style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('memberc1')">Member Count <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="memberc2" data-sort="memberc:desc" hidden style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('memberc2')">Member Count <span class="glyphicon glyphicon-triangle-top"></span></button>
            </div>

            <div class="series" id="mix-wrapper3">
                @foreach($groups as $group)
                    <div class="mix ttr" data-name="{{ $group->name }}" data-founder="{{ loadUser($group->founderId)[0]->username }}" data-memberc="{{ count(listUsersOfGroup($group->id)) }}" onclick="window.location.href='/groups/{{$group->id}}';">
                        <div class="ttd" style="width: calc(33.3333333% - 3px);">{{ $group->name }}</div>
                        <div class="ttd dd"  style="width: calc(33.3333333% - 3px);">{{ loadUser($group->founderId)[0]->username }}</div>
                        <div class="ttd dd"  style="width: calc(33.3333333% - 3px);">{{ count(listUsersOfGroup($group->id)) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <h2>Guides</h2><hr>
    @if($guides)
        <div class="container">
            <div class="series ttr" id="tr1" style="padding-top: 5px">
                <button class="sort" id="titlee1" style="width: calc(50% - 3px); text-align: center" data-sort="title:asc" onclick="myScripts.switchDataSort('titlee1')">Title <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="titlee2" style="width: calc(50% - 3px); text-align: center" data-sort="title:desc" hidden onclick="myScripts.switchDataSort('titlee2')">Title <span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="sort" id="author1" style="width: calc(50% - 3px); text-align: center" data-sort="author:asc" onclick="myScripts.switchDataSort('author1')">Author <span class="glyphicon glyphicon-triangle-bottom"></span></button>
                <button class="sort" id="author2" style="width: calc(50% - 3px); text-align: center" data-sort="author:desc" hidden onclick="myScripts.switchDataSort('author2')">Author <span class="glyphicon glyphicon-triangle-top"></span></button>
            </div>

            <div class="series" id="mix-wrapper4">
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
    @endif

    <h2>Users</h2><hr>
    @include('partials.usersList')

    <script>
        myScripts.initializeMixItUp();
        $('#mix-wrapper2').mixItUp({
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
        $('#mix-wrapper3').mixItUp({
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
        $('#mix-wrapper4').mixItUp({
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
