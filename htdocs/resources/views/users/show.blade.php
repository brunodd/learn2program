@extends('master')

@section('head')
    <style>
        .profileheader {
            float: left;
            padding: 5px;
        }

        .profileheader img {
            width:50px;
            height:50px;
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
    </style>

@stop

@section('title')
    <div class="profileheader">
        <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
        <b><em>{{ $user->username }}</em></b></br>
        <small><em><font color="white">Score: {{ $user->score }}</font></em></small>
    </div>

    @if( Auth::check() and ($user->id == Auth::id()) )
        <div style="float: right;color: white;"><a href="{{ action('UsersController@edit', $user->username )}}" class="btn btn-primary">Edit</a></div>
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
            <div class="jumbotron" style="padding: 10px 35px;max-height: 60%;overflow-y: auto;position: fixed;"><h3 style="text-align: center;">Accomplishments</h3>
                <div class="row">
                    <u><h4>Completed series</h4></u>
                    @foreach($allseries as $serie )
                        @if( hasCompletedAllExercisesInSerie($user, $serie) )
                            <strong> {{$serie->title}} </strong>
                            <?php $exercises = getAllExercisesOfSeries($serie); ?>
                            <div class="container-fluid">
                            @foreach($exercises as $exercise)
                                @if ( getAccomplishedExercise($user, $exercise) )
                                    @if ( userSucceededExercise($exercise->exId, $user->id) )
                                    <div style="float: left", "color: white">
                                        <a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 50) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        was solved correctly!
                                        </div></br>
                                    @else
                                    <div style="float: left", "color: white">
                                        <em><a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 50) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        was incorrect...</em>
                                        </div></br>
                                    @endif
                                @endif
                            @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <u><h4>Work in progress</h4></u>
                        @foreach($allseries as $serie )
                            @if( hasNotCompletedWholeSerie($user, $serie) )
                                <strong>{{$serie->title}}</strong>
                                <?php $exercises = getAllExercisesOfSeries($serie); ?>
                                <div class=container-fluid>
                                @foreach($exercises as $exercise)
                                    @if ( userSucceededExercise($exercise->exId, $user->id) )
                                    <div style="float: left", "color: white">
                                        <a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 20) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        was solved correctly!
                                        </div></br>
                                    @elseif ( getAccomplishedExercise($user, $exercise) )
                                    <div style="float: left", "color: white">
                                        <em><a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 20) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        was incorrect...</em>
                                        </div></br>
                                    @else
                                    <div style="float: left", "color: white">
                                        <em><a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 20) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        has not been started yet!</em>
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
                                <strong> {{$serie->title}} </strong>
                                <?php $oneNotStartedSerie = true; ?>
                                <?php $exercises = getAllExercisesOfSeries($serie); ?>
                                <div class="container-fluid">
                                @foreach($exercises as $exercise)
                                    @if ( getAccomplishedExercise($user, $exercise) )
                                    <div style="float: left", "color: white">
                                        <a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 20) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        has been accomplished!
                                        </div></br>
                                    @else
                                    <div style="float: left", "color: white">
                                        <em><a href="/exercises/{{ $exercise->id }}"><font color="white">{{ firstChars($exercise->question, 20) }} </font></a>
                                        </div></br>
                                    <div style="float: right">
                                        has not been started yet!</em>
                                        </div></br>
                                    @endif
                                @endforeach
                                </div>
                            @endif
                        @endforeach
                        <?php if(!$oneNotStartedSerie)
                            echo "You started all the series! Nicely done! \n"?>
                </div>
            </div>
        </div>
        <div class=col-md-7>
            <h3>Something about me:</h3>
            <p>{{ $user->info }}</p>
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
