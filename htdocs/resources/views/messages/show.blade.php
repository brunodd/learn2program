@extends('master')

@section('title')
    <em>Messages: {{ $user->username }}</em>
@stop

@section('content')
    <div style="float: left;height:400px;width: 30%;overflow:auto;">

        <div class="form-group" role="form" method="POST" action="/login">
            <input type="text" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-default" style="visibility: hidden;">Submit</button>
        </div>

        @foreach ($conversations as $conversation)
            <div>
                <b><a href={{ action('MessagesController@show', $conversation->userB) }}> {{ $conversation->userB }} </a></b><br>
                {{$conversation->message}}<br>
            </div>
            <hr>
        @endforeach
    </div>


    <div id="1" style="height:400px;width:100% solid #ccc;font:16px/26px;overflow:auto;padding-left: 15px;">
        @foreach ($messages as $message)
            <p style="float:left;"> <b>{{$message->username}}</b> </p>
            <p style="float:right;"> {{$message->date}} </p> <br>
            <div style="clear:both;"></div>
            <p> {{$message->message}} </p>
            <hr>
        @endforeach

    </div>

    <script>
        var myDiv = document.getElementById("1");
        myDiv.scrollTop = myDiv.scrollHeight;
    </script>

    <br>

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
