<script>
    function CheckEmptySearchForm() {
        return (document.getElementById('searchword').value != "");
    }
</script>

<nav class="navbar navbar-inverse navbar-fixed-top"> <!-- "navbar-static-top" -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <!-- maybe add an image here -->
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Learn2Program
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
                    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@search', 'onsubmit' => 'return CheckEmptySearchForm()', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                    <div class="form-group" >
                        {!! Form::text('searchword', null, ['class' => 'form-control', 'placeholder' => 'Search', 'id' => 'searchword', 'autocomplete' => 'off' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </li>

                @if (Auth::user())
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <span class="glyphicon glyphicon-certificate"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="">Lijstje van recente notifications</a></li>
                            <li class="divider"></li>
                            <li><a href="/notifications">See all notifications</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="">Lijstje van recente messages</a></li>
                            <li class="divider"></li>
                            <li><a href="/notifications">See all messages</a></li>
                        </ul>
                    </li>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <img src="images/users/user{{ \Auth::id() }}ProfilePicture.jpg" alt="Profile Picture" style="max-width:50px;max-height:20px">
                            {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
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
