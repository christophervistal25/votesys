@extends('admin.templates.master' , [
'title'       => 'Create position',
'voting_state' => getCurrentStateOfVote(),
'admin'       => getAdminInfo()
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
<form method="POST" autocomplete="off">
	<div class="form-group">
		<div class="row">
			<div class="col-md-12"><label>Position : </label>
			<input name="name" type="text" class="form-control"  placeholder="Position">
		</div>
	</div>
</div>
<br>
<div class="form-group">
	<div class="row">
		<div class="col-md-12"><label >No. of can run</label>
		<input name="limit" type="number" class="form-control" placeholder="No. of candidate that can run">
	</div>
</div>
<br>
<div class="form-group">
	<div class="row">
		<div class="col-md-12"><label >Student can vote : </label>
		<input name="student_can_vote" type="number" class="form-control" placeholder="Students can vote">
	</div>
</div>
</div>
<input type="submit" value="Add this position" class="text-capitalize pull-right btn btn-primary">
</form>
@endsection
