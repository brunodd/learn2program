<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Laravel</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Learn2Program
                <div class="small">
                    @yield('title')
                </div>
            </h1>
        </div>
        @yield('content')

        @include('errors.list')
    </div>
</body>
</html>
