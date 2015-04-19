@extends('master')

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
@stop
