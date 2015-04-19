<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <span class="glyphicon glyphicon-heart"></span> Learn2Program
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/series">Series</a></li>
                <li><a href="/exercises">Exercises</a></li>
                <li><a href="/groups">Groups</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/users">Users</a></li>
                <li><a href="/statistics">Statistics</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@search', 'onsubmit' => "return myScripts.CheckEmptySearchForm('searchword')", 'class' => 'navbar-form navbar-right']) !!}
                        <div class="form-group" >
                            {!! Form::text('searchword', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'searchword', 'autocomplete' => 'off' ]) !!}
                        </div>
                    {!! Form::close() !!}
                </li>

                @if (Auth::user())
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" onclick="{{ updateNotificationsToSeen() }}; myScripts.removeStyle('drop')">
                            @if($unreadNotification)
                                <span id="drop" class="glyphicon glyphicon-certificate" style="color: red;"></span>
                            @else
                                <span id="drop" class="glyphicon glyphicon-certificate"></span>
                            @endif

                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @for($x = 0; $x < sizeof($last5notifications); $x += 2)
                                @if($last5notifications[$x + 1] == 0)
                                    <li style="background-color: lightgrey">
                                @else
                                    <li>
                                @endif

                                <a href="">
                                    {{$last5notifications[$x]}}
                                </a></li>
                            @endfor
                            <li class="divider"></li>
                            <li><a href="/notifications">See all notifications</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            @if($unreadMessage)
                                <span class="glyphicon glyphicon-envelope" style="color: red;"></span>
                            @else
                                <span class="glyphicon glyphicon-envelope"></span>
                            @endif
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @for($x = 0; $x < sizeof($last5conversations); $x += 6)
                                @if($last5conversations[$x + 3] == 0 and $last5conversations[$x + 4] != \Auth::id())
                                    <li style="background-color: lightgrey">
                                @else
                                    <li>
                                @endif

                                <a href="/messages/{{ $last5conversations[$x] }}">
                                    <img src="/images/users/{{ $last5conversations[$x+1] }}" alt="Profile Picture" style="max-width:50px;max-height:50px;float: left;padding: 0 5px 0 0;">
                                    <p><b> {{ $last5conversations[$x] }} </b></p>
                                    {{$last5conversations[$x+2]}}
                                    <div style="clear:both;"></div>
                                </a></li>
                            @endfor
                            <li class="divider"></li>
                            <li><a href="/messages">See all messages</a></li>
                        </ul>
                    </li>

                    <li class="dropdown ">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img src="/images/users/{{ loadUser(Auth::user()->id)[0]->image }}" alt="Profile Picture" style="max-width:50px;max-height:20px">
                            {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">My Series</a></li>
                            <li><a href="#">My Exercises</a></li>
                            <li><a href="#">My Friends</a></li>
                            <li><a href="#">My Groups</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('UsersController@edit', Auth::user()->username )}}">Settings</a></li>
                            <li><a href="/logout">Log out</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/login">Log in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
