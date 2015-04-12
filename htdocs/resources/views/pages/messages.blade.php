@extends('master')

@section('title')
    <em>Messages: {{ $user->username }}</em>
@stop

@section('content')
    <div style="float: left;height:400px;width: 30%;overflow:auto;">

        <div class="form-group" role="form" method="POST" action="">
            <input type="text" class="form-control" placeholder="Search for users">
            <button type="submit" class="btn btn-default" style="visibility: hidden;">Submit</button>
        </div>

        @foreach ($conversations as $conversation)
            <img src="/images/users/{{ loadUser($conversation->userB)[0]->image }}" alt="Profile Picture" style="max-width:50px;max-height:50px;float:left;padding: 0 5px 0 0;">

            <div>
                <b><a href={{ action('MessagesController@show', $conversation->userB) }}> {{ $conversation->userB }} </a></b><br>
                {{$conversation->message}}<br>
            </div>
            <hr>
        @endforeach
    </div>


    <!-- TODO: copy facebook for prettier displaying -->
    <div id="messageBox" style="height:400px;width:100% solid #ccc;font:16px/26px;overflow:auto;padding-left: 15px;">
        @foreach ($messages as $message)
            <a href="/users/{{$message->username}}">
                <img src="/images/users/{{ loadUser($message->username)[0]->image }}" alt="Profile Picture" style="max-width:50px;max-height:50px;float: left;padding: 0 5px 0 0;">
            </a>
            <a href="/users/{{$message->username}}">
                <p style="float:left;"><b> {{$message->username}} </b></p>
            </a>
            <p style="float:right;"> {{$message->carbon->diffForHumans()}} </p><br>
            <div style="clear:both;"></div>
            <p> {{$message->message}} </p>
            <hr>
        @endforeach
    </div>

    <script>
        myScripts.SetScrollBoxToBottom('messageBox');
    </script>

    <br>

    <!-- TODO: copy facebook for prettier displaying -->
    @if ($user->username != '')
        {!! Form::open(['action' => 'MessagesController@store']) !!}
            <div class="form-group" >
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>
                {!! Form::hidden('username', $user->username) !!}
            <div class="form-group" >
                {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}
    @endif

    @include('errors.list')
@stop
