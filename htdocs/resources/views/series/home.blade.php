@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Series home page
@stop

@section('content')
    <h2>List of all series:</h2>

    <table style="width:100%">
        <tr>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByNameASC')}}" class="btn btn-primary">Sort by name, ascending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByRatingASC')}}" class="btn btn-primary">Sort by rating, ascending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedBySubASC')}}" class="btn btn-primary">Sort by subject, ascending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByDiffASC')}}" class="btn btn-primary">Sort by difficulty, ascending</a></td>
        </tr>

        <tr>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByNameDESC')}}" class="btn btn-primary">Sort by name, descending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByRatingDESC')}}" class="btn btn-primary">Sort by rating, descending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedBySubDESC')}}" class="btn btn-primary">Sort by subject, descending</a></td>
            <td align="center"><a href="{{ action('SeriesController@indexSortedByDiffDESC')}}" class="btn btn-primary">Sort by difficulty, descending</a></td>
        </tr>

        @foreach($series as $serie)
            <tr>
                <td align="center"><h3><a href="{{ action('SeriesController@show', [$serie->title])}}">{{$serie->title}}</a></h3></td>
                <td align="center"><h3>{{ averageRating($serie->id) }}</h3></td>
                <td align="center"><h3>{{ loadType2($serie->tId)[0]->subject }}</h3></td>
                <td align="center"><h3>{{ loadType2($serie->tId)[0]->difficulty }}</h3></td>
            </tr>
        @endforeach
    </table>

    @if ( Auth::check() )
        <h2><a href="series/create">Create new series</a></h2>
    @else
        <h2><a href="/login">User login</a></h2>
    @endif

    <hr/>

    <div class="container">
        <h4>Filter by</h4>

        <div class="options">
            <button class="filter" data-filter="all">All</button>
            <button class="filter" data-filter=".easy">Easy</button>
            <button class="filter" data-filter=".intermediate">Intermediate</button>
            <button class="filter" data-filter=".hard">Hard</button>
            <button class="filter" data-filter=".insane">Insane</button>
        </div>
        <div style="clear: both"></div>

        <h4>Sort by</h4>

        <div class="options">
            <button class="sort" data-sort="default:asc">Default</button>
            <button class="sort" data-sort="random">Random</button>
            <button class="sort" id="rating1" data-sort="rating:asc" onclick="myScripts.switchDataSort('rating1')">Rating</button>
            <button class="sort" id="rating2" data-sort="rating:desc" hidden onclick="myScripts.switchDataSort('rating2')">Rating</button>
            <button class="sort" id="subject1" data-sort="subject:asc" onclick="myScripts.switchDataSort('subject1')">Subject</button>
            <button class="sort" id="subject2" data-sort="subject:desc" hidden onclick="myScripts.switchDataSort('subject2')">Subject</button>
            <button class="sort" id="difficulty1" data-sort="difficulty:asc" onclick="myScripts.switchDataSort('difficulty1')">Difficulty</button>
            <button class="sort" id="difficulty2" data-sort="difficulty:desc" hidden onclick="myScripts.switchDataSort('difficulty2')">Difficulty</button>
        </div>
        <div style="clear: both"></div>

        <h5>Series</h5>

        <!--div class="series" id="mix-wrapper">
            @foreach($series as $serie)
                <div class="mix {{ loadType2($serie->tId)[0]->difficulty }}" data-title="{{$serie->title}}" data-rating="{{ averageRating($serie->id) }}" data-subject="{{ loadType2($serie->tId)[0]->subject }}" data-difficulty="{{ loadType2($serie->tId)[0]->difficulty }}">
                    <p><a href="{{ action('SeriesController@show', [$serie->title])}}">{{$serie->title}}</a> | {{ averageRating($serie->id) }} | {{ loadType2($serie->tId)[0]->subject }} | {{ loadType2($serie->tId)[0]->difficulty }}</p>
                </div>
            @endforeach
        </div-->

        <div class="series">
            <table id="mix-wrapper" style="width: 100%">
                <tr> <th>Title</th> <th>Rating</th> <th>Subject</th> <th>Difficulty</th> </tr>
                @foreach($series as $serie)
                        <tr class="mix {{ loadType2($serie->tId)[0]->difficulty }} clickable-row" data-title="{{$serie->title}}" data-rating="{{ averageRating($serie->id) }}" data-subject="{{ loadType2($serie->tId)[0]->subject }}" data-difficulty="{{ loadType2($serie->tId)[0]->difficulty }}" data-href="/series/{{$serie->title}}">
                            <td>{{$serie->title}}</td>
                            <td>{{ averageRating($serie->id) }}</td>
                            <td>{{ loadType2($serie->tId)[0]->subject }}</td>
                            <td>{{ loadType2($serie->tId)[0]->difficulty }}</td>
                        </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script>
        myScripts.initializeMixItUp();
        myScripts.makeTrClickable();
    </script>
@stop
