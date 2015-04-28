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
    </style>

@stop

@section('title')
    <div class="profileheader">
        <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
        <b><em>{{ $user->username }}</em></b>
    </div>

    @if( Auth::check() and ($user->id == Auth::id()) )
        <div style="float: right;color: white;"><a href="{{ action('UsersController@edit', $user->username )}}" class="btn btn-primary">Edit</a></div>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
    <div class=container-fluid>
        <div class="row">
            <?php
            $allseries = DB::select('SELECT *  
                                    FROM series
                                    WHERE series.id = series.id');
            ?>
            <div class="col-md-3">
                <div class="jumbotron"><h3>Accomplishments</h3>
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
                                            Exercise {{$exercise->exId}} was solved correctly!
                                        @else
                                            <em>Exercise {{$exercise->exId}} was incorrect... </em>
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
                                        @if ( getAccomplishedExercise($user, $exercise) )
                                            Exercise {{$exercise->id}} accomplished! <br>
                                        @else
                                            Exercise {{$exercise->id}} not started! <br>
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
                                            Exercise {{$exercise->id}} accomplished! <br>
                                        @else
                                            Exercise {{$exercise->id}} not started! <br>
                                        @endif
                                    @endforeach
                                    </div>
                                @endif
                            @endforeach
                            <?php if(!$oneNotStartedSerie)
                                echo "You started all the serie! Nicely done! \n"?>
                    </div>
                </div>
            </div>
            <div class=col-md-9>
                <h3>Something about me:</h3>
                <p>{{ $user->info }}</p>
                @if (Auth::check() and $user->id != Auth::id())
                    <div class="form-group" >
                        <a href="{{ action('MessagesController@show', $user->username )}}">
                        <input class="btn btn-primary" type="submit" value="Send message"></a>
                    </div>
                    <br>

                    @if (cansendfriendrequest($user->id))
                        {!! Form::open(['action' => ['UsersController@addFriend', $user->username]]) !!}
                            <div class="form-group" >
                                {!! Form::submit('add as friend', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    @elseif (isfriendrequestpending($user->id))
                        {!! Form::open(['action' => ['UsersController@acceptfriend', $user->username]]) !!}
                        <div class="form-group" >
                            {!! Form::submit('accept friend request', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['action' => ['UsersController@declinefriend', $user->username]]) !!}
                        <div class="form-group" >
                            {!! Form::submit('decline friend request', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    @elseif (!empty(loadfriend($user->id)))
                        {!! Form::open(['action' => ['UsersController@removefriend', $user->username]]) !!}
                            <div class="form-group" >
                                {!! Form::submit('remove friend', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    @elseif (issentfriendrequestpending($user->id))
                        <div class="form-group btn btn-primary disabled" >
                            friend request pending
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @stop
