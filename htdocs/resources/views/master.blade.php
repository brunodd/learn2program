<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Learn 2 Program</title>

    <link rel="stylesheet" href="/css/all.css">
    <script src="/js/all.js"></script>
</head>
<body>
    @include('partials.navbar');

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Learn2Program
                <div class="small">
                    @yield('title')
                </div>
            </h1>
        </div>
        @yield('content')
    </div>
</body>
</html>
