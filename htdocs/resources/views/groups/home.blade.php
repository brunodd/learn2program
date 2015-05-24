@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">
@stop

@section('title')
    Groups
@stop

@section('content')
    <div class="container">

        <div class="series ttr" id="tr1" style="padding: 5px 15px">
            <button class="sort" id="name1" data-sort="name:asc" style=" width: calc(33.3333333% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name1')">Name <span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="name2" data-sort="name:desc" hidden style=" width: calc(33.3333333% - 3px); text-align: left;" onclick="myScripts.switchDataSort('name2')">Name <span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="sort" id="founder1" data-sort="founder:asc" style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('founder1')">Founder <span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="founder2" data-sort="founder:desc" hidden style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('founder2')">Founder <span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="sort" id="memberc1" data-sort="memberc:asc" style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('memberc1')">Member Count <span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <button class="sort" id="memberc2" data-sort="memberc:desc" hidden style=" width: calc(33.3333333% - 3px);" onclick="myScripts.switchDataSort('memberc2')">Member Count <span class="glyphicon glyphicon-triangle-top"></span></button>
        </div>

        <div class="series" id="mix-wrapper">
            @foreach($groups as $group)
                <div class="mix ttr" data-name="{{ $group->name }}" data-founder="{{ loadUser($group->founderId)[0]->username }}" data-memberc="{{ count(listUsersOfGroup($group->id)) }}" onclick="window.location.href='/groups/{{$group->id}}';">
                    <div class="ttd" style="width: calc(33.3333333% - 3px);">{{ $group->name }}</div>
                    <div class="ttd dd"  style="width: calc(33.3333333% - 3px);">{{ loadUser($group->founderId)[0]->username }}</div>
                    <div class="ttd dd"  style="width: calc(33.3333333% - 3px);">{{ count(listUsersOfGroup($group->id)) }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        myScripts.initializeMixItUp();
    </script>


    @if( Auth::check() )
        <h2><a href="groups/create">Create new group</a></h2>
    @endif

    @include('errors.list')
@stop
