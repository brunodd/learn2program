@extends('master')

@section('head')
    <style>
        .profileheader {
            min-width: 250px;
            color: white;
            float: left;
            padding: 5px;
        }

        .profileheader img {
            width:100px;
            height:100px;
            float:left;
            margin-right: 5px;
        }

        .btn {
            width: 175px;
            margin-bottom: 10px;
        }

        .col-md-2 a, .col-md-2 form, .col-md-2 .btn {
            float: right;
        }

        .col-md-2:after {
            content: "";
            display: block;
            clear: both;
        }

        .col-md-3 a {
            color: white;
        }
    </style>

@stop

@section('title')
    <div class="profileheader">
        <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
        <b>{{ $user->username }}</b>
        <p style="margin: 0"><i>Score: {{ $user->score }}</i></p>
    </div>

    @if( Auth::check() and ($user->id == Auth::id()) )
        <a href="{{ action('UsersController@edit', $user->username )}}" class="btn btn-primary"  style="float:right; width: auto;"><i class="glyphicon glyphicon-edit"></i> Edit</a>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
    <div class="row" style="height: 100%;width: 100%">
        <?php
        $allseries = DB::select('SELECT *
                                FROM series
                                WHERE series.id = series.id');
        ?>
        <div class="col-md-3" style="height: 100%;">
            <div class="jumbotron" style="padding: 10px 35px;max-height: 600px;overflow-y: auto;position: relative;">
                <h3 style="text-align: center;">Accomplishments</h3>
                <div class="row">
                    <u><h4>Completed series</h4></u>
                    @foreach($allseries as $serie )
                        @if( hasCompletedAllExercisesInSerie($user, $serie) )
                            <strong><a href="/series/{{$serie->title}}">
                                {{$serie->title}}
                            </a></strong><br/>
                        @endif
                    @endforeach
                </div>

                <div class="row">
                <u><h4>Work in progress</h4></u>
                    @foreach($allseries as $serie )
                        @if( hasNotCompletedWholeSerie($user, $serie) )
                            <strong><a href="/series/{{$serie->title}}">
                                {{$serie->title}}
                            </a></strong><br/>
                            <?php $exercises = getAllExercisesOfSeries($serie); ?>
                            <div class=container-fluid>
                            @foreach($exercises as $exercise)
                                <div style="float: left">
                                    <em><a href="/exercises/{{ $exercise->id }}" style="color: white">
                                    {{ firstChars(strip_tags($exercise->question), 20) }}</a></em>
                                </div></br>
                                @if ( userSucceededExercise($exercise->exId, $user->id) )
                                <div style="float: right">
                                    was solved correctly!
                                </div></br>
                                @elseif ( getAccomplishedExercise($user, $exercise) )
                                <div style="float: right">
                                    was incorrect.
                                </div></br>
                                @else
                                <div style="float: right">
                                    has not been started yet!
                                </div></br>
                                @endif
                            @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="row">
                    <u><h4>To do</h4></u>
                    <?php $oneNotStartedSerie = false; ?>
                    @foreach($allseries as $serie )
                        @if( hasNotStartedSerie($user, $serie) )
                            <strong><a href="/series/{{$serie->title}}">
                                {{$serie->title}}
                            </a></strong><br/>
                            <?php $oneNotStartedSerie = true; ?>
                        @endif
                    @endforeach
                    <?php if(!$oneNotStartedSerie) echo $user->username . " started all the series! Nicely done! \n"?>
                </div>
            </div>
        </div>

        <div class=col-md-7>
        <h2>About {{$user->username}}:</h2>
        {!! $user->info !!}
        </div>

        <div class="col-md-2">

            @if (Auth::check())
                <a href="{{ action('MessagesController@show', $user->username )}}">
                    <input class="btn btn-primary" type="submit" value="Send message">
                </a>
            @endif

            @if (Auth::check() and $user->id != Auth::id())
                @if (cansendfriendrequest($user->id))
                    {!! Form::open(['action' => ['UsersController@addFriend', $user->username]]) !!}
                        {!! Form::submit('Add as friend', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                @elseif (isfriendrequestpending($user->id))
                    {!! Form::open(['action' => ['UsersController@acceptFriend', $user->username]]) !!}
                        {!! Form::submit('Accept friend request', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                    {!! Form::open(['action' => ['UsersController@declineFriend', $user->username]]) !!}
                        {!! Form::submit('Decline friend request', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                @elseif (!empty(loadfriend($user->id)))
                    {!! Form::open(['action' => ['UsersController@removeFriend', $user->username]]) !!}
                        {!! Form::submit('Remove friend', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                @elseif (issentfriendrequestpending($user->id))
                    <div class="btn btn-primary disabled" >
                        Friend request pending
                    </div>
                @endif
            @endif
        </div>
    </div>
@stop
