<h3>Register</h3>
<form class="form-group" action="{{route('user.register.post')}}" method="post">

  {{csrf_field()}}
  <input type="hidden" name="tab" value="register"/>

  <label class="label" for="name">
	<input name="name" placeholder="Name" class="form-control" type="text" min="3"
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
	<input name="email" placeholder="Email" class="form-control" type="email"
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

  <p>
  @if(session('registration_exception'))
	<div class="alert alert-danger alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <strong>{{ session('registration_exception') }}</strong>
	</div>
	@endif
	</p>

	<label class="label" for="register-btn">
	  <input id="register-btn" class="btn btn-info" type="submit" value="Register"/>
	</label>
</form>