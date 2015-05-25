@extends('master')

@section('head')
    <style>
        .member {
            width: 100%;
            min-height: 60px;
            padding: 5px;
            margin-bottom: 10px;
            border-bottom: solid 1px #9d9c9b;
            float: left;
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

        .dataAndButtons {
            float: right;
            width: calc(100% - 55px);
        }

        .profiledata {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            float: left;
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

        .manage {
            margin-bottom: 5px;
            font-weight: 700;
        }

        .members {
            overflow-y: auto;
            height: 450px;
            background: white;
            border: 1px solid rgb(204, 204, 204);
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* enable absolute positioning */
        .inner-addon {
            float: right;
            position: relative;
        }

        /* style icon */
        .inner-addon .glyphicon {
            color: #ffffff;
            position: absolute;
            padding: 3px 0 0 5px;
            pointer-events: none;
        }

        /* align icon */
        .left-addon .glyphicon  { left:  0px;}

        /* add padding  */
        .left-addon input  { padding-left:  17px; }

        .hover-content {
            display: none;
        }
        .inner-addon:hover .hover-content{
            position: absolute;
            display: block;
            width: 120px;
            background: #ffffff;
            border-radius: 5px;
            border: 1px solid lightgrey;
            padding: 0 5px;
            right: 25px;
            top: 0px;
        }

        .aboutuser {
            height: 20px;
        }

        .aboutuser * {
            margin: 0;
            padding: 0;
        }
    </style>
@stop

@section('title')
    Manage members for group: <em>{{ $group->name }}</em>
@stop

@section('content')

    <div class="col-md-5">
        <div class="manage">Manage members</div>
        <div class="members">
            @foreach($members as $member)
                @if ($member->id == $group->founderId)
                @else
                    <div class="member">
                        <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $member->username )}}'">
                            <img src="/images/users/{{ $member->image }}" alt="Profile Picture">
                        </div>
                        <div class="dataAndButtons">
                            <div class="profiledata">
                                <a href="{{ action('UsersController@show', $member->username )}}">{{ $member->username }}</a>
                                <div class="aboutuser">{!! strip_tags($member->info) !!}</div>
                            </div>

                            {!! Form::open(['action' => ['GroupsController@removeMember', $group->id, $member->id]]) !!}
                                <div class="inner-addon left-addon">
                                    <i class="glyphicon glyphicon-remove"></i>
                                    <input class="btn btn-xs btn-primary" type="submit" value="" />
                                    <div class="hover-content">
                                        Remove member
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div style="clear: both;"></div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="col-md-5 col-lg-offset-2">
        @if($group->private)
            <div class="manage">Member requests</div>
            <div class="members">
                @foreach($membersRequests as $member)
                    @if ($member->id == $group->founderId)
                    @else
                        <div class="member">
                            <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $member->username )}}'">
                                <img src="/images/users/{{ $member->image }}" alt="Profile Picture">
                            </div>
                            <div class="dataAndButtons">
                                <div class="profiledata">
                                    <a href="{{ action('UsersController@show', $member->username )}}">{{ $member->username }}</a>
                                    <div class="aboutuser">{!! strip_tags($member->info) !!}</div>
                                </div>

                                <div style="float: right">
                                    {!! Form::open(['action' => ['GroupsController@acceptMember', $group->id, $member->id]]) !!}
                                    <div class="inner-addon left-addon" style="margin-bottom: 2px;">
                                        <i class="glyphicon glyphicon-ok"></i>
                                        <input class="btn btn-xs btn-primary" type="submit" value="" />
                                        <div class="hover-content">
                                            Accept member
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                    {!! Form::open(['action' => ['GroupsController@declineMember', $group->id, $member->id]]) !!}
                                    <div class="inner-addon left-addon">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <input class="btn btn-xs btn-primary" type="submit" value="" />
                                        <div class="hover-content">
                                            Remove member
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                        <div style="clear: both;"></div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <div class="col-md-5 {{ $group->private ? "" : "col-lg-offset-2" }}">
        <div class="manage">Members {{ $group->private ? "declined/kicked" : "kicked" }}</div>
        <div class="members">
            @foreach($membersDeclined as $member)
                @if ($member->id == $group->founderId)
                @else
                    <div class="member">
                        <div class="profilepic" onclick="location.href='{{ action('UsersController@show', $member->username )}}'">
                            <img src="/images/users/{{ $member->image }}" alt="Profile Picture">
                        </div>
                        <div class="dataAndButtons">
                            <div class="profiledata">
                                <a href="{{ action('UsersController@show', $member->username )}}">{{ $member->username }}</a>
                                <div class="aboutuser">{!! strip_tags($member->info) !!}</div>
                            </div>

                            {!! Form::open(['action' => ['GroupsController@acceptMember', $group->id, $member->id]]) !!}
                            <div class="inner-addon left-addon">
                                <i class="glyphicon glyphicon-ok"></i>
                                <input class="btn btn-xs btn-primary" type="submit" value="" />
                                <div class="hover-content">
                                    Accept member
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div style="clear: both;"></div>
                @endif
            @endforeach
        </div>
    </div>
@stop


