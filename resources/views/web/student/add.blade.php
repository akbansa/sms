@extends('web.layouts.main')

@section('title', 'Add a student')

@section('content')
  <div class="row">
	<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 vertical-alignment-content">
	  <div class="panel panel-success">
		<div class="panel-heading">Add Student</div>
		  <div class="panel-body">
			<form class="form-group" method="post" action="{{route('student.create.post')}}">
			  {{ csrf_field() }}

			  {{-- Name --}}
			  <label class="label" for="name">
			  	<input id="name" name="name" placeholder="Name" class="form-control" min="3"
					   type="text" value="@if(old('name')) {{old('name')}} @endif"/>
			  </label>
			  @if($errors->has('name'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  	@foreach($errors->get('name') as $error)
					  <strong>{{ $error }}</strong>
				  	@endforeach
				</div>
			  @endif

			  {{-- Address --}}
			  <label class="label" for="address">
				<textarea id="address" name="address" placeholder="Address" rows="5"
						class="form-control">@if(old('address')){{old('address')}}@endif</textarea>
			  </label>
			  @if($errors->has('address'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  @foreach($errors->get('address') as $error)
					<strong>{{ $error }}</strong>
				  @endforeach
				</div>
			  @endif
			  <br>

			  {{-- Gender --}}
			  <label class="radio-inline">
				<input name="gender" type="radio" value="{{config('sms.static_variables.male')}}"
					 @if(old('gender')==config('sms.static_variables.male')) checked @endif/> Male
			  </label>
			  <label class="radio-inline">
				<input name="gender" type="radio" value="{{config('sms.static_variables.female')}}"
					 @if(old('gender')==config('sms.static_variables.female')) checked @endif/> Female
			  </label>
			  @if($errors->has('gender'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  @foreach($errors->get('gender') as $error)
					<strong>{{ $error }}</strong>
				  @endforeach
				</div>
			  @endif
			  <br>

			  {{-- Passing Year --}}
			  <label class="label" for="year">
				<select id="year" name="year" class="form-control">
				  <option selected disabled>Select Year</option>
				  @for($i=date('Y');$i>=date('Y')-10;$i--)
					<option value="{{ $i }}" @if(old('year') == $i) selected @endif>{{$i}}</option>
				  @endfor
				</select>
			  </label>
			  @if($errors->has('year'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  @foreach($errors->get('year') as $error)
					<strong>{{ $error }}</strong>
				  @endforeach
				</div>
			  @endif
			  <br>

			  {{-- Interests --}}
			  <div class="checkbox">
			  @foreach($interests as $interest)
				<label class="checkbox-inline">
				  <input name="interests[]" value="{{$interest->id}}"
				  	@if(isset(old()['interests']))
					  @if(in_array($interest->id,old('interests'))) checked @endif
				  	@endif
					type="checkbox">{{$interest->name}}
				</label>
			  @endforeach
			  </div>
			  @if($errors->has('interests'))
				<div class="alert alert-danger alert-block">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  @foreach($errors->get('interests') as $error)
					<strong>{{ $error }}</strong>
				  @endforeach
				</div>
			  @endif

			  {{-- Add button --}}
			  <label class="label">
				<input class="btn btn-success" type="submit" value="Add Student"/>
			  </label>

			  <label class="label" for="back-btn">
				<a href="{{route('student.view')}}"><input type="button" class="btn btn-info" value="View All"/></a>
			  </label>
			</form>
		  </div>
		</div>
	</div>
  </div>
@endsection