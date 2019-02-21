@extends('admin.templates.master' , [
	'title'        => 'Import students',
	'voting_state' => getCurrentStateOfVote(),
	'admin'        => getAdminInfo()
])
@section('content')
@if (hasMessage('errors'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong style="color:#fff;">{!! getFlashMessage('errors') !!}</strong>
	</div>
	@php
		flushMessage('errors');
	@endphp
	@elseif(hasMessage('status'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong style="color:#fff;">{!! getFlashMessage('status') !!}</strong>
	</div>
	@php
		flushMessage('status');
	@endphp
@endif
<form method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12" style="margin-top : 1vw;">
			<label>CSV File : </label>
			<input type="file" name="csv">
		</div>
	</div>
	<input type="submit" value="Import students" class="btn btn-primary pull-right">
</form>
@endsection
