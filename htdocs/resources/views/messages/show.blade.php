@extends('master')

@section('title')
    <em>Messages: {{ $user->username }}</em>
@stop

@section('content')
    <div style="float: left;height:49em;width: 30%;overflow:auto;">
        @foreach ($conversations as $conversation)
            <div>
                <b><a href={{ action('MessagesController@show', $conversation->userB) }}> {{ $conversation->userB }} </a></b><br>
                {{$conversation->message}}<br>
            </div>
            <hr>
        @endforeach
    </div>


    <div id="1" style=";height:49em;width:100% solid #ccc;font:16px/26px;overflow:auto;padding-left: 15px">
        @foreach ($messages as $message)
        <div>
            <b>{{$message->username}}</b><br>
            {{$message->message}}<br>
        </div>

        <div align="right">
            {{$message->date}}<br>
        </div>
        <hr>
        @endforeach

    </div>

    <script>
        var myDiv = document.getElementById("1");
        myDiv.scrollTop = myDiv.scrollHeight;
    </script>

    <br>
    {!! Form::open(['action' => 'MessagesController@store']) !!}
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        {!! Form::hidden('username', $user->username) !!}
        {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

    @include('errors.list')
@stop
