@extends('admin.templates.master' , [
	'title'        => 'List of positions',
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
<table class="table  table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Limit</th>
			<th>No. of candidate</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($positions as $position)
		<tr>
			<th><b>{{ $position->name }}</b></th>
			<th><b>{{ $position->limit }}</b></th>
			<th>{{ $position->candidate->count() }}</th>
			<td class="text-center"><a class="btn btn-primary" href="/admin/position/edit/{{ $position->id }}" >EDIT</a><a class="btn btn-danger"  href="/admin/position/destroy/{{ $position->id }}">DELETE</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
