@extends('master')

@section('head')
    <style>
        .chat {
            background: #eeeeee;
            border-radius: 15px;
            border: 1px solid rgb(222, 223, 226);;
            position: absolute;
            width: 95%;
            height: calc(100% - 65px);
        }

        .col-md-5, .col-md-7 {
            min-height: 550px;
            max-height: 1000px;
            height: 50%;
        }

        #myForm, #messageBox {
            border: none;
        }

        #messageBox {
            border-bottom: 1px solid rgb(222, 223, 226);;
        }
    </style>
@stop

@section('title')
    <em>{{ $group->name }}</em>

    @if(Auth::check())
    <div style="float: right">
        @if (isGroupRequestPending(\Auth::id(), $group->id))
            <div class="btn btn-primary disabled" style="opacity: .8;">
                Join request pending
            </div>
        @elseif ($isMember)
            {!! Form::open(['action' => ['GroupsController@leave', $group->id], 'style' => "display: inline-block"]) !!}
            {!! Form::submit('Leave group', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @elseif (isGroupRequestDeclined(\Auth::id(), $group->id))
            <div class="btn btn-primary disabled" style="opacity: .8;">
                You have been declined or kicked from this group
            </div>
        @else
            {!! Form::open(['action' => ['GroupsController@join', $group->id], 'style' => "display: inline-block"]) !!}
            {!! Form::submit('Join group', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @endif

        @if( Auth::check() and isFounderOfGroup($group->id, Auth::id()) )
            <a href="{{ action('GroupsController@manageMembers', $group->name )}}" class="btn btn-primary">Manage members</a>
            <a href="{{ action('GroupsController@edit', $group->name )}}" class="btn btn-primary" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
        @endif
    </div>
    <div style="clear: both"></div>
    @endif
@stop

@section('content')
    @if (!$isMember && $group->private)
        <div class="alert alert-danger">This is a private group, join it to get access.</div>
    @else
        <div class="col-md-7">
            <h3><b style="color: #0b3557;">Chat</b></h3>
            <div class="chat">
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
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    @endforeach
                </div>

                @if ($isMember)
                    {!! Form::open(['action' => 'GroupsController@storeMessage', 'id' => 'myForm']) !!}
                    {!! Form::textarea('message', null, ['class' => 'mmessageText', 'rows' => 1, 'cols' => 1, 'id' => 'fucker']) !!}
                    {!! Form::hidden('conversationId', $group->conversationId) !!}
                    {!! Form::hidden('groupname', $group->name) !!}
                    {!! Form::submit('Send', ['class' => 'btn btn-primary mmessageButton', 'style' => 'padding: 0 12px;']) !!}
                    {!! Form::close() !!}
                @else
                    <style>
                        #messageBox {
                            height: 92%;
                        }
                    </style>
                    <div id="myForm" style="height: 8%">Join this group to gain acces to chat.</div>
                @endif

            </div>
        </div>

        <div class="col-md-5">
            <h3><b style="color: #0b3557;">Members</b></h3>

            <div class="users">
                @include('partials.usersList')
            </div>
        </div>
    @endif

    <script>
        $('document').ready(function () {
            myScripts.SetScrollBoxToBottom('messageBox');
            document.getElementById('fucker').removeAttribute('rows');
            document.getElementById('fucker').removeAttribute('cols');
        });
    </script>
@stop
