@extends('admin.templates.master' , [
'title' => 'Create Candidate',
'voting_state' => getCurrentStateOfVote(),
'admin' => getAdminInfo()
])
@section('content')
@if (hasMessage('errors'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong style="color:#fff;">{{ getFlashMessage('errors') }}</strong>
	</div>
	@php
		flushMessage('errors');
	@endphp
@endif
<form method="POST" enctype="multipart/formdata">
	<div class="row">
		<div class="col-md-12">
			<label>Select Student : </label>
			<select name="student_id"  class="form-control">
				@foreach ($need_data['students'] as $student)
				<option value="{{ $student->student_id }}">{{ $student->firstname . $student->lastname }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="row">
		<div class="form-group">
			<div class="col-md-12" style="margin-top : 1vw;">
				<label>Running for : </label>
				<select name="position_id" class="form-control">
					@foreach ($need_data['positions'] as $position)
					<option value="{{ $position->id }}">{{ $position->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12" style="margin-top : 1vw;">
			<label>Platforms : </label>
			<textarea class="form-control" name="platforms" cols="30" rows="10"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" style="margin-top : 1vw;">
			<label>Profile : </label>
			<input type="file" name="candidate_profile">
		</div>
	</div>
	<input type="submit" value="Add candidate" class="btn btn-primary pull-right">
</form>
@endsection
