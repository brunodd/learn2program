@extends('master')

@section('head')
    <style>
        .member {
            width: 100%;
            min-height: 60px;
            padding: 5px;
            margin-bottom: 10px;
            border-bottom: solid 1px #9d9c9b;
        }

        .profilepic {
            width:50px;
            height:50px;
            float:left;
            margin-right: 5px;
        }

        .profilepic img {
            width:50px;
            height:50px;
        }

        .profilepic img:hover {
            cursor: pointer;
        }

        .profiledata {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            float: right;
            direction: ltr;
            width: calc(100% - 55px);
        }

        .profiledata * {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profiledata a {
            font-weight: bold;
        }

        .chat {
            background: #eeeeee;
            border-radius: 15px;
            border: 1px solid rgb(222, 223, 226);;
            position: absolute;
            width: 95%;
            height: calc(100% - 65px);
        }

        .members {
            overflow-x: auto;
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

        .aboutuser {
            height: 20px;
        }

        .aboutuser * {
            margin: 0;
            padding: 0;
        }
    </style>
    <?php
        $users = listUsersOfGroup($group->id);
    ?>
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

                <script>
                    myScripts.SetScrollBoxToBottom('messageBox');
                </script>

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

                <script>
                    $('document').ready(function () {
                        document.getElementById('fucker').removeAttribute('rows');
                        document.getElementById('fucker').removeAttribute('cols');
                    });
                </script>
            </div>
        </div>

        <div class="col-md-5">
            <h3><b style="color: #0b3557;">Members</b></h3>

            <div class="members">
            @foreach($users as $user)
                <div class="member">
                    <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
                        <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
                    </div>
                    <div class="profiledata">
                        <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
                        <div class="aboutuser">{!! $user->info !!}</div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div style="clear: both;"></div>
            @endforeach
            </div>
        </div>
    @endif
@stop
