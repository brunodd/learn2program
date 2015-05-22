@extends('master')

@section('title')
    <em>Messages: {{ $user->username }}</em>
@stop

@section('content')

    <div class="mmessage">
        <div class="mmessageLeft">

            <!-- TODO: implement this  some day
            <div class="mmessageSearch form-group" role="form" method="POST" action="">
                <input type="text" class="form-control" placeholder="Search for users">
                <button type="submit" class="btn btn-default" style="visibility: hidden;">Submit</button>
            </div-->

            @foreach ($conversations as $conversation)
                @if ($conversation->author != \Auth::id() AND $conversation->is_read == 0)
                    <div class="conversationElem" style="background: lightgrey" onclick="window.location.href='/messages/{{ $conversation->username }}'">
                @else
                    <div class="conversationElem" onclick="window.location.href='/messages/{{ $conversation->username }}'">
                @endif
                    <div style="float: right">
                        {{$conversation->carbon->diffForHumans()}}
                    </div>
                    <img src="/images/users/{{ $conversation->image }}" alt="Profile Picture">

                    <div>
                        <b><a href={{ action('MessagesController@show', $conversation->username) }}> {{ $conversation->username }} </a></b><br>
                        {{$conversation->message}}
                    </div>
                    </div>
                    <div style="clear:both;"></div>
            @endforeach
        </div>


        <div class="mmessageRight">
            <div id="messageBox" class="mmessageBox">
                @foreach ($messages as $message)
                    <div class="mmessageElem">
                        <div class="mmessageRightLeft">
                            <a href="/users/{{$message->username}}">
                                <img src="/images/users/{{ loadUser($message->username)[0]->image }}" alt="Profile Picture">
                            </a>
                        </div>
                        <div class="mmessageRightRight">
                            <div class="mmessageAuthor">
                                <a href="/users/{{$message->username}}">
                                    {{$message->username}}
                                </a>
                            </div>
                            <div class="mmessageDate">
                                {{$message->carbon->diffForHumans()}}
                            </div>
                            <div style="clear:both;"></div>
                            <div class="mmessageMessage">
                                <p style="margin: 0;">{!! nl2br($message->message) !!}</p>
                                @if($message->seen == 1) <!-- TODO: if($message->seen) -->
                                    <span class="glyphicon glyphicon-ok"> <small>Seen</small></span>
                                @endif
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                @endforeach
            </div>

            <script>
                myScripts.SetScrollBoxToBottom('messageBox');
            </script>

            @if ($user->username != '')
                {!! Form::open(['action' => 'MessagesController@store', 'id' => 'myForm']) !!}
                    {!! Form::textarea('message', null, ['class' => 'mmessageText', 'rows' => 1, 'cols' => 1, 'id' => 'fucker']) !!}
                    {!! Form::hidden('username', $user->username) !!}
                    {!! Form::submit('Send', ['class' => 'btn btn-primary mmessageButton']) !!}
                {!! Form::close() !!}
            @endif
        </div>
    </div>
    <div style="clear:both;"></div>

    <script>
        $('document').ready(function () {
            document.getElementById('fucker').removeAttribute('rows');
            document.getElementById('fucker').removeAttribute('cols');
        });
    </script>
    @include('errors.list')
@stop
