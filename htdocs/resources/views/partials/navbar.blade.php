<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <span class="glyphicon glyphicon-heart"></span> <b>Learn2Program</b>
            </a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown ">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        Learning & Practicing
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/series">Series</a></li>
                        <li><a href="/exercises">Exercises</a></li>
                        <li><a href="/guides">Guides</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        Community
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/users">Users</a></li>
                        <li><a href="/groups">Groups</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        Statistics
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/statistics">Graphs</a></li>
                        <li><a href="/leaderboard">Leaderboard</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        Help
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/faqs">FAQs</a></li>
                        <li><a href="/about">About</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@search', 'onsubmit' => "return myScripts.CheckEmptySearchForm('searchword')", 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="form-group" >
                            {!! Form::text('s', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'searchword', 'autocomplete' => 'off', 'class' => 'form-control']) !!}
                        </div>
                    {!! Form::close() !!}
                <li>

                @if (Auth::user())
                    <li id="notifclick" class="dropdown">
                        @if($unreadNotification)
                            <a href="" id="drop" class="dropdown-toggle glyphicon glyphicon-certificate" data-toggle="dropdown" role="button" style="color: red;" onclick="myScripts.changeElementColor('drop', 'darkgrey')"></a>
                        @else
                            <a href="" id="drop" class="dropdown-toggle glyphicon glyphicon-certificate" data-toggle="dropdown" role="button"></a>
                        @endif

                        <ul class="dropdown-menu" role="menu">
                            @for($x = 0; $x < sizeof($last5notifications); $x += 2)
                                @if($last5notifications[$x + 1] == 0)
                                    <li  class="notification newnotification">
                                @else
                                    <li class="notification">
                                @endif
                                <!-- onclick="window.location.href='';"-->
                                <div>
                                    <?php echo $last5notifications[$x] ?>
                                </div>
                                </li>
                            @endfor
                            <li class="divider"></li>
                            <li style="width: 386px;"><a style="padding: 3px 10px" href="/notifications">See all notifications</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        @if($unreadMessage)
                            <a href="" class="dropdown-toggle glyphicon glyphicon-envelope" data-toggle="dropdown" role="button" style="color: red;"></a>
                        @else
                            <a href="" class="dropdown-toggle glyphicon glyphicon-envelope" data-toggle="dropdown" role="button"></a>
                        @endif
                        <ul class="dropdown-menu" role="menu">
                            @for($x = 0; $x < sizeof($last5conversations); $x += 6)
                                <li class="message">
                                @if($last5conversations[$x + 3] == 0 and $last5conversations[$x + 4] != \Auth::id())
                                    <div class="mya" onclick="location.href='/messages/{{ $last5conversations[$x] }}'" style="background-color: lightgrey">
                                @else
                                    <div class="mya"  onclick="location.href='/messages/{{ $last5conversations[$x] }}'">
                                @endif
                                    <div class="messageLeft">
                                        <img src="/images/users/{{ $last5conversations[$x+1] }}" alt="Profile Picture">
                                    </div>
                                    <div class="messageRight">
                                        <div class="messAuth">{{ $last5conversations[$x] }}</div>
                                        <div class="messMess">
                                            @if($last5conversations[$x+3] == 1)
                                                <span class="messSeen glyphicon glyphicon-ok"></span>
                                            @endif
                                            <div>{{ $last5conversations[$x+2] }}</div>
                                        </div>
                                        <div class="messDate">{{ $last5conversations[$x+5]->diffForHumans() }}</div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    </div>
                                </li>
                                    <div style="clear:both;"></div>
                            @endfor
                            <li class="divider"></li>
                            <li style="width: 430px;"><a href="/messages">See all messages</a></li>
                        </ul>
                    </li>

                    <li class="dropdown ">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img src="/images/users/{{ loadUser(Auth::user()->id)[0]->image }}" alt="Profile Picture" style="max-width:50px;max-height:20px">
                            {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('UsersController@show', Auth::user()->username )}}">My Profile</a></li>
                            <li><a href="/my_friends">My Friends</a></li>
                            <li><a href="/challenges">My Challenges</a></li>
                            <li class="divider"></li>
                            <li><a href="/my_series">My Series</a></li>
                            <li><a href="/my_groups">My Groups</a></li>
                            <li><a href="/my_exercises">My Exercises</a></li>
                            <li><a href="/my_guides">My Guides</a></li>
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
