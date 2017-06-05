@extends('web.layouts.auth')

@section('title', 'Reset Password')

@section('content')
  <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-12 vertical-alignment">
	  <h3>Reset Password</h3>
	  <form class="form-group" action="{{route('user.reset.post')}}" method="post">

		{{csrf_field()}}

		{{-- Reset Token--}}
		<input type="hidden" name="token" value="{{$token}}"/>
		@if($errors->has('token'))
		  <div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			@foreach($errors->get('token') as $error)
			  <strong>{{ $error }}</strong>
			@endforeach
		  </div>
		@endif

		{{-- Email --}}
		<label class="label">
		  <input name="email" placeholder="Email" class="form-control" type="email"
				 value="@if(old('email')){{old('email')}}@endif"/>
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
		<label class="label">
		  <input name="password" placeholder="Password" class="form-control" type="password"/>
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
		<label class="label">
		  <input name="password_confirmation" placeholder="Confirm Password" class="form-control" type="password"/>
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
		@if(session('reset_password_exception'))
		  <div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ session('reset_password_exception') }}</strong>
		  </div>
		@endif
		</p>
		<label class="label" for="js-reset-btn">
		  <input id="reset-btn" class="btn btn-info" type="submit" value="Reset"/>
		</label>
	  </form>
	</div>
@endsection