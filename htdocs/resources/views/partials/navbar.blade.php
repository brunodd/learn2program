<nav class="navbar navbar-inverse navbar-fixed-top"> <!-- "navbar-static-top" -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
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

                <li><a href="/list_all_users">Users</a></li>

                <li><a href="/groups">Groups</a></li>

                <li><a href="/about">About</a></li>
            </ul>


            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                        Dropdown Example
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>

                <li>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search hier doen?">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </li>

                @if (Auth::user())
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            Logged in as {{ Auth::user()->username }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="/logoutj">Log out</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/login">Log in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>