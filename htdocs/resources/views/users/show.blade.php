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
        <div style="float: right"><a href="{{ action('UsersController@edit', $user->username )}}"><font color="white">Edit</font></a></div>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')
    <p> {{ $user->info }}</p>

    @if (Auth::check() and $user->id != Auth::id())
        <div class="form-group" >
            <a href="{{ action('MessagesController@show', $user->username )}}">
            <input class="btn btn-primary" type="submit" value="Send message"></a>
        </div>
        <br>

        @if (canSendFriendRequest($user->id))
            {!! Form::open(['action' => ['UsersController@addFriend', $user->username]]) !!}
                <div class="form-group" >
                    {!! Form::submit('Add as friend', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        @elseif (isFriendRequestPending($user->id))
            {!! Form::open(['action' => ['UsersController@acceptFriend', $user->username]]) !!}
            <div class="form-group" >
                {!! Form::submit('Accept friend request', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['action' => ['UsersController@declineFriend', $user->username]]) !!}
            <div class="form-group" >
                {!! Form::submit('Decline friend request', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        @elseif (!empty(loadFriend($user->id)))
            {!! Form::open(['action' => ['UsersController@removeFriend', $user->username]]) !!}
                <div class="form-group" >
                    {!! Form::submit('Remove friend', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        @elseif (isSentFriendRequestPending($user->id))
            <div class="form-group btn btn-primary disabled" >
                Friend request pending
            </div>
        @endif
    @endif

    <?php
    $allseries = DB::select('SELECT *  
                            FROM series
                            WHERE series.id = series.id');
    ?>

    <h4>ACCOMPLISHMENT:</h4>

    @foreach($allseries as $serie )
        @if( hasCompletedAllExercisesInSerie($user, $serie) )
            {{$serie->title}} <br>
            <?php $exercises = getAllExercisesOfSeries($serie); ?>
            @foreach($exercises as $exercise)
                @if ( getAccomplishedExercise($user, $exercise) )
                    Exercise {{$exercise->id}} accomplished! <br>
                @endif
            @endforeach
        @endif
    @endforeach
    
    <h4>NOT FINISHED:</h4>
        <?php $oneNotFinishedSerie = false; ?>
        @foreach($allseries as $serie )
            @if( hasNotCompletedWholeSerie($user, $serie) )
                {{$serie->title}} <br>
                <?php $oneNotFinishedSerie = true; ?>
                <?php $exercises = getAllExercisesOfSeries($serie); ?>
                @foreach($exercises as $exercise)
                    @if ( getAccomplishedExercise($user, $exercise) )
                        Exercise {{$exercise->id}} accomplished! <br>
                    @else
                        Exercise {{$exercise->id}} not started! <br>
                    @endif
                @endforeach
            @endif
        @endforeach
        <?php if(!$oneNotFinishedSerie)
                 echo "You don't have any 'not fully solved' Serie. \n"?>

    <h4>NOT STARTED:</h4>
        <?php $oneNotStartedSerie = false; ?>
        @foreach($allseries as $serie )
            @if( hasNotStartedSerie($user, $serie) )
                {{$serie->title}} <br>
                <?php $oneNotStartedSerie = true; ?>
                <?php $exercises = getAllExercisesOfSeries($serie); ?>
                @foreach($exercises as $exercise)
                    @if ( getAccomplishedExercise($user, $exercise) )
                        Exercise {{$exercise->id}} accomplished! <br>
                    @else
                        Exercise {{$exercise->id}} not started! <br>
                    @endif
                @endforeach
            @endif
        @endforeach
        <?php if(!$oneNotStartedSerie)
            echo "You started all the serie! Nicely done! \n"?>

    @stop
