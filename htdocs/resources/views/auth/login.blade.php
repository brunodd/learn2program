@extends('master')

@section('head')
    <style>
        #derpderp:hover {
            color: white;
            background-color: #3B5998;
        }
    </style>
@stop

@section('title')
    Login
@stop

@include('login.loginhead')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><center>Member Login</center></div>
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
					@include('login.loginbody')
					<br>
					<div style="height: 1px; background-color: black; text-align: center">
					  <span style="background-color: white; position: relative; top: -0.7em;">
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

                        <!-- commented out the "remember" checkbox in case we use it later -->
						<!--
						    <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" @if (old('remember') == 'on') checked @endif> Remember Me
									</label>
								</div>
							</div>
                            </div>
                        -->
		   				<h6 align="center" style="position: relative;left: +30px;">By creating an account, you agree to our <span class="term"><a href="#">Terms & Conditions</a></span></h6>

                        <div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button id="derpderp" type="submit" class="btn btn-primary-large" style="margin-right: 15px; width: 360px;">
									Login
								</button>
                            </div>
                        </div>

                        <!--div class="col-md-6 col-md-offset-0">
                        <a href="/email" style="position: relative;left: -50px; top:10px;" ><Forgot Your Password?</a>
                        </div-->

                        <!--div class="form-group">
                            <div class="col-md-8 col-md-offset-5">
                                <a href="/register" style="margin-left: 14px; position:relative; left:100px; top:-25px;">Don't have an account? Sign Up!</a>
                            </div>
                        </div-->

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-5" style="padding: 0;">
                                <a href="/register" style="margin: 0 auto;">Don't have an account? Sign Up!</a>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
