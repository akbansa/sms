@extends('web.layouts.main')

@section('title', 'Student Records')

@section('content')
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-2 col-sm-12 vertical-alignment-content">
            @if (session('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Year</th>
                    <th>Activites</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if(count($students)>0)
                    @foreach($students as $student)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->address}}</td>
                        <td>
						  @if($student->gender==config('sms.static_variables.male'))
							Male
						  @else
						  	Female
						  @endif
						</td>
                        <td>{{$student->year}}</td>
                        <td>
						@if(count($student->interests)>0)
						  @foreach($student->interests->pluck('name') as $interest)
                          	{{$interest}},
						  @endforeach
					  	@else
						  -
						@endif
						</td>
                        <td>
                            <a href="{{route('student.edit.get',['id' => $student->id ])}}"><input class="btn btn-sm btn-info" type="button" value="Edit"></a></td>
                        <td>
                            <form name="deleteForm" action="{{route('student.delete',['id'=>$student->id])}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"><h3 class="text-center">No Results Found!</h3></td>
                    </tr>
                @endif
                </tbody>
            </table>

                {{-- Add button --}}
            <a class="btn btn-success" href="{{route('student.create.get')}}"> Add Student</a>
        </div>
    </div>
@endsection