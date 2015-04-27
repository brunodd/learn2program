<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('tabName')Learn 2 Program</title>
        <!-- TODO: add tabName sections to some pages -->

        <link rel="stylesheet" href="/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/all.js"></script>
        @include('web.homepagehead')

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
                    <h2>
                        @yield('title')
                    </h2>
                </div>
                @yield('content')
            </div>
        </div>

        <footer>
            @yield('footer')
            @include('partials.translator')
            @include('socialmedia.FacebookShare')
            <div class="copy text-center">
                <span>&#169</span> All rights reserved | Design by Learn2program-team
            </div>
        </footer>

        <script>
            myScripts.doModal();
            myScripts.alertSlideUp();
            jQuery(document).ready( function() {
                //Clicking on the notifications icon will send an ajax request to set all notifications to seen
                //TODO: armin, improve function
                myScripts.ajaxPostNotificationsRead();
            });
        </script>
    </body>
</html>