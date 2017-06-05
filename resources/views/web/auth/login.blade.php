@extends('web.layouts.auth')

@section('title', 'Login to Student Management System')

@section('content')

    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-12 vertical-alignment">
	  @if (session('message'))
		<div class="alert alert-success alert-block">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>{{ session('message') }}</strong>
		</div>
	  @endif
	  <input type="hidden" id="tab" value="@if(old('tab')){{old('tab')}}@endif"/>
        <ul class="nav nav-tabs">
            <li id="loginTab" class="active"><a data-toggle="tab" href="#login">Login</a></li>
            <li id="registerTab"><a data-toggle="tab" href="#register">Register</a></li>
            <li id="forgotTab"><a data-toggle="tab" href="#forgot">Forgot</a></li>
        </ul>
        <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
                <h3>Login</h3>
                <form class="form-group" action="{{route('user.login.post')}}" method="post">

				  {{csrf_field()}}
				  <input type="hidden" name="tab" value="login"/>

				  {{-- Login Email --}}
                    <label class="label" for="email">
                        <input name="loginEmail" id="email" placeholder="Email" class="form-control" type="email"
							   required="required"
							   value="@if(old('loginEmail')){{old('loginEmail')}}@endif"/>
                    </label>
					@if($errors->has('loginEmail'))
					  <div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						@foreach($errors->get('loginEmail') as $error)
						  <strong>{{ $error }}</strong>
						@endforeach
					  </div>
					@endif

				  {{-- Login Password--}}
                    <label class="label" for="password">
                        <input name="loginPassword" id="password" placeholder="Password" class="form-control" min="8"
							   type="password" required="required"
						/>
                    </label>
					@if($errors->has('loginPassword'))
					  <div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						@foreach($errors->get('loginPassword') as $error)
						  <strong>{{ $error }}</strong>
						@endforeach
					  </div>
					@endif

				  	<br>

					<input name="remember" id="remember" type="checkbox"/> Remember Me

				    <p>
				  @if(session('invalid_login_credentials'))
					<div class="alert alert-danger alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>{{ session('invalid_login_credentials') }}</strong>
					</div>
					@endif
					</p>
				  	<label class="label" for="js-login-btn">
                        <input id="login-btn" class="btn btn-info" type="submit" value="Login"/>
                    </label>
                </form>
            </div>
            <div id="register" class="tab-pane fade">
                <h3>Register</h3>
                <form class="form-group" action="{{route('user.register.post')}}" method="post">

				  {{csrf_field()}}
				  <input type="hidden" name="tab" value="register"/>

				  <label class="label" for="name">
					  <input name="name" id="name" placeholder="Name" class="form-control" type="text" min="3"
							 required="required" value="@if(old('name')){{old('name')}}@endif"/>
				  </label>
				  @if($errors->has('name'))
					<div class="alert alert-danger alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  @foreach($errors->get('name') as $error)
						<strong>{{ $error }}</strong>
					  @endforeach
					</div>
				  @endif

				  {{-- Email --}}
				  <label class="label" for="emailRegister">
					  <input name="email" id="emailRegister" placeholder="Email" class="form-control" type="email"
							 required="required" value="@if(old('email')){{old('email')}}@endif"/>
				  </label>
				  @if($errors->has('email'))
					<div class="alert alert-danger alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  @foreach($errors->get('email') as $error)
						<strong>{{ $error }}</strong>
					  @endforeach
					</div>
				  @endif

				  {{-- Password --}}
				  <label class="label" for="passwordRegister">
					  <input name="password" placeholder="Password" class="form-control" min="8" type="password"
					  required="required"/>
				  </label>
				  @if($errors->has('password'))
					<div class="alert alert-danger alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  @foreach($errors->get('password') as $error)
						<strong>{{ $error }}</strong>
					  @endforeach
					</div>
				  @endif

				  {{-- Password Confirm --}}
				  <label class="label" for="passwordRegisterConfirm">
					  <input name="password_confirmation" placeholder="Confirm Password" class="form-control" min="8"
							 type="password" required="required"/>
				  </label>
				  @if($errors->has('password_confirmation'))
					<div class="alert alert-danger alert-block">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  @foreach($errors->get('password_confirmation') as $error)
						<strong>{{ $error }}</strong>
					  @endforeach
					</div>
				  @endif

				  <br>
				  <label class="label" for="register-btn">
					  <input id="register-btn" class="btn btn-info" type="submit" value="Register"/>
				  </label>
                </form>
            </div>
		  	<div id="forgot" class="tab-pane fade">
			<h3>Forgot Password</h3>
			<form class="form-group" action="{{route('user.forgot.post')}}" method="post">

			  {{csrf_field()}}
			  <input type="hidden" name="tab" value="forgot"/>

			  {{-- Forgot Password Email --}}
			  <label class="label" for="email">
				<input name="forgotEmail" placeholder="Email" class="form-control" type="email" required="required"
					   value="@if(old('forgotEmail')){{old('forgotEmail')}}@endif"/>
			  </label>
			  @if($errors->has('forgotEmail'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  @foreach($errors->get('forgotEmail') as $error)
					<strong>{{ $error }}</strong>
				  @endforeach
				</div>
			  @endif

			  <br>
			  <label class="label" for="js-forgot-btn">
				<input id="forgot-btn" class="btn btn-success" type="submit" value="Get Password"/>
			  </label>
			</form>
		  </div>
        </div>
    </div>
@endsection