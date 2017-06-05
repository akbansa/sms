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
  @if($errors->has('loginPassword') && !$errors->has('loginEmail'))
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