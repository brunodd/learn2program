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
        @include('partials.navbar')

        <div class="wrapper">
            <div class="container-fluid">
                @include('flash::message')
                <script>
                    doModal();
                    alertSlideUp();
                </script>

                <div class="jumbotron">
                    <h1><div class="small">
                        @yield('title')
                    </div></h1>
                </div>
                @yield('content')
            </div>
            <div class="push"></div>
        </div>

        @yield('footer')
        <div class="footer">
            <p>This <strong>CSS Sticky Footer</strong> simply stays put.</p>
            @include('partials.translator')
        </div>
    </body>
</html>
