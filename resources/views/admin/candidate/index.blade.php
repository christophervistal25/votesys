@extends('admin.templates.master' , [
	'title'        => 'List of Candidates',
	'voting_state' => getCurrentStateOfVote(),
	'admin'        => getAdminInfo()
])
@section('content')
@if (hasMessage('status'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong style="color:#fff;">{{ getFlashMessage('status') }}</strong>
	</div>
	@php
		flushMessage('status');
	@endphp
@endif
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Fullname</th>
			<th>Running for</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($candidates as $candidate)
		<tr>
        <th>{{ucfirst($candidate->studentInfo->lastname) }} , {{ucfirst($candidate->studentInfo->firstname)}} {{ucfirst(substr($candidate->studentInfo->middlename,0,1))}}.</th>
        <th>{{ucfirst($candidate->position->name)}}</th>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
