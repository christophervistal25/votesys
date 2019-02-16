@extends('admin.templates.master',[
	'title' => ucfirst(last(explode('/',URL::current()))),
	'voting_state' => getCurrentStateOfVote(),
	'admin' => getAdminInfo()
])

@section('content')
@if (hasMessage('status'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong style="color:#fff;">{{ getFlashMessage('status') }}</strong>
	</div>
@endif

<div class="row">
	<div class="col-md-6">
		<h5 class="text-capitalize">Vote status : <b> {{ (getCurrentStateOfVote())  }}</b></h5>
	</div>
	@if (getCurrentStateOfVote() === 'closed')
	<div class="pull-right">
		<form method="POST">
			<input type="submit" class="text-capitalize btn btn-primary" value="Start the voting">
		</form>
	</div>
	@endif
</div>
@endsection
