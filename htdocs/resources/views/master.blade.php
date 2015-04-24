<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('tabName')Learn 2 Program</title>
        <!-- TODO: add tabName sections to some pages -->

        <link rel="stylesheet" href="/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/all.js"></script>

        @yield('head')
    </head>

    <body>
        <div class="wrapper">
            <header>
                @include('partials.navbar')
            </header>

            <div class="container-fluid">
                @include('flash::message')

                <div class="jumbotron">
                    <h1><div id="pieceofshit5" class="small">
                            @yield('title')
                        </div></h1>
                </div>
                @yield('content')
            </div>
        </div>

        <footer>
            @yield('footer')
            @include('partials.translator')
            @include('socialmedia.FacebookShare')
        </footer>

        <script>
            myScripts.doModal();
            myScripts.alertSlideUp();
        </script>
    </body>
</html>