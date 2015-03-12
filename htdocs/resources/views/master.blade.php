<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Learn 2 Program</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/all.css">
    <script src="/js/all.js"></script>
    @yield('head')
</head>
@include('partials.navbar')

<body>
    <div class="container-fluid">
        @include('flash::message')

        <script>
            $('#flash-overlay-modal').modal();
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        </script>

        <div class="jumbotron">
            <h1><div class="small">
                @yield('title')
            </div></h1>
        </div>

        @yield('content')
    </div>
</body>
</html>
