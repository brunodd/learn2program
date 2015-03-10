@extends('master')

@section('title')
    <em>Messages: {{ $user->username }}</em>
@stop

@section('content')
    <style>
        table, th, td {
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
    </style>

    @foreach ($messages as $message)
    <table style="width:100%">
        <tr>
            <th>{{$message->author }}</th>
        </tr>
        <tr>
            <td>{{$message->message}}</td>
        </tr>
        <tr>
            <td align="right">{{$message->date}}</td>
        </tr>
    </table>
    <hr> <br>
    @endforeach

    {!! Form::open(['action' => 'MessagesController@store']) !!}
        <div class="form-group" >
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::hidden('username', $user->username) !!}
        <div class="form-group" >
        {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@stop
