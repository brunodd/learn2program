@extends('master')

@section('title')
    Groups home page
@stop

@section('content')
    <h2>List of all groups:</h2>

     <table style="width:100%">
     <tr>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByNameASC')}}" class="btn btn-primary">Sort by name, ascending</a></td>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByFounderASC')}}" class="btn btn-primary">Sort by founder, ascending</a></td>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByMCASC')}}" class="btn btn-primary">Sort by member count, ascending</a></td>
     </tr>

     <tr>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByNameDESC')}}" class="btn btn-primary">Sort by name, descending</a></td>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByFounderDESC')}}" class="btn btn-primary">Sort by founder, descending</a></td>
      <td align="center"><a href="{{ action('GroupsController@indexSortedByMCDESC')}}" class="btn btn-primary">Sort by member count, descending</a></td>
     </tr>

    @foreach($groups as $group)
        <tr>
         <td align="center"><h3><a href="{{ action('GroupsController@show', [$group->name])}}">{{$group->name}}</a></h3></td>
         <td align="center"><h3>{{ loadUser($group->founderId)[0]->username }}</h3></td>
         <td align="center"><h3>{{ count(listUsersOfGroup($group->id)) }}</h3></td>
        </tr>
    @endforeach
    </table>


    @if( Auth::check() )
        <h2><a href="groups/create">Create new group</a></h2>
    @else
        <h2><a href="/login">User login</a></h2>
    @endif

    @include('errors.list')
@stop
