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
		@include('web.partials.login')
	  </div>
	  <div id="register" class="tab-pane fade">
		@include('web.partials.register')
	  </div>
	  <div id="forgot" class="tab-pane fade">
		@include('web.partials.forgot-password')
	  </div>
	</div>
</div>
@endsection