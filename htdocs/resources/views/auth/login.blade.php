@extends('master')

@section('title')
    Login
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
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

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Login
								</button>
								<a href="/facebook/login"  style="margin-left: 14px;">Login with Facebook</a> 
								<a href="/email">Forgot Your Password?</a>
							</div>
						</div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-5">

                                <a href="/register"  style="margin-left: 14px;">Create an account</a>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
