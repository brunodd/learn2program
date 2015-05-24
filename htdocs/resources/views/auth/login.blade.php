@extends('master')

@section('head')
    <link href="/css/web/loginstyle.css" rel='stylesheet' type='text/css'>

    <style>
        #derpderp {
            width: 100%;
        }

        #derpderp:hover {
            color: white;
            background-color: #3B5998;
        }

        .panel-heading {
            text-align: center;
        }
    </style>
@stop

@section('title')
    Login
@stop

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Member Login</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="social-icons">
                    <div class="col_1_of_f span_1_of_f">
                        <a href="facebook/login">
                            <ul class='facebook'>
                                <i class="fb"> </i>
                                <li>Connect with Facebook</li>
                                <div style='clear:both'></div>
                            </ul>
                        </a>
                    </div>

                    <div class="col_1_of_f span_1_of_f">
                        <a href="twitter/login">
                            <ul class='twitter'>
                                <i class="tw"> </i>
                                <li>Connect with Twitter</li>
                                <div style='clear:both'></div>
                            </ul>
                        </a>
                    </div>
                    <div style='clear:both'></div>
                </div>

                <br>
                <div style="height: 1px; background-color: black; text-align: center">
                    <span style="background-color: white; position: relative; top: -0.7em; padding: 0 3px;">
                        Or connect with
                    </span>
                </div>
                <br><br>

                <form class="form-horizontal" role="form" method="POST" action="/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input type="input" class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="pass">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            <button id="derpderp" type="submit" class="btn btn-primary-large">
                                Login
                            </button>
                            <div style="padding-top: 10px; text-align: right">
                                <a href="/register">Don't have an account? Sign Up!</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="application/x-javascript">
        function hideURLbar(){
            window.scrollTo(0,1);
        }
        addEventListener("load", function() {  setTimeout(hideURLbar, 0);  }, false);
    </script>
@endsection
