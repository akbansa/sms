<h3>Forgot Password</h3>
<form class="form-group" action="{{route('user.forgot.post')}}" method="post">

  {{csrf_field()}}
  <input type="hidden" name="tab" value="forgot"/>

  {{-- Forgot Password Email --}}
  <label class="label" for="email">
	<input name="forgotEmail" placeholder="Email" class="form-control" type="email" required="required"
		   value="@if(old('forgotEmail')){{old('forgotEmail')}}@endif"/>
  </label>

  <p>
  @if($errors->has('forgotEmail'))
	<div class="alert alert-danger alert-block">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  @foreach($errors->get('forgotEmail') as $error)
		<strong>{{ $error }}</strong>
	  @endforeach
	</div>
	@endif
	</p>

	<label class="label" for="js-forgot-btn">
	  <input id="forgot-btn" class="btn btn-success" type="submit" value="Get Password"/>
	</label>
</form>