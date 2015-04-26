@extends('master')

@section('head')
    <script src="/js/mixitup.js"></script>
    <link rel="stylesheet" href="/css/sortingAndFiltering.css">

    <style>
        .dd {
            float: right;
        }
    </style>
@stop

@section('title')
    Groups
@stop

@section('content')
    <div class="container">
        <h4>Sort by</h4>

        <div class="options">
            <button class="sort" id="name1" data-sort="name:asc" onclick="myScripts.switchDataSort('name1')">Name</button>
            <button class="sort" id="name2" data-sort="name:desc" hidden onclick="myScripts.switchDataSort('name2')">Name</button>
            <button class="sort" id="founder1" data-sort="founder:asc" onclick="myScripts.switchDataSort('founder1')">Founder</button>
            <button class="sort" id="founder2" data-sort="founder:desc" hidden onclick="myScripts.switchDataSort('founder2')">Founder</button>
            <button class="sort" id="memberc1" data-sort="memberc:asc" onclick="myScripts.switchDataSort('memberc1')">Member Count</button>
            <button class="sort" id="memberc2" data-sort="memberc:desc" hidden onclick="myScripts.switchDataSort('memberc2')">Member Count</button>
            <button class="sort" data-sort="random">Random</button>
        </div>
        <div style="clear: both"></div>

        <div class="series" id="mix-wrapper">
            <div class="ttr" id="tr1">
                <div class="ttd">Name</div>
                <div class="ttd dd">Member Count</div>
                <div class="ttd dd">Founder</div>
            </div>
            @foreach($groups as $group)
                <div class="mix ttr" data-name="{{ $group->name }}" data-founder="{{ loadUser($group->founderId)[0]->username }}" data-memberc="{{ count(listUsersOfGroup($group->id)) }}" onclick="window.location.href='/groups/{{$group->name}}';">
                    <div class="ttd">{{ $group->name }}</div>
                    <div class="ttd dd">{{ count(listUsersOfGroup($group->id)) }}</div>
                    <div class="ttd dd">{{ loadUser($group->founderId)[0]->username }}</div>
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
