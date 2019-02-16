@extends('admin.templates.master' , [
'title'       => 'Create position',
'voting_state' => getCurrentStateOfVote(),
'admin'       => getAdminInfo()
])
@section('content')
<form method="POST" autocomplete="off">
	<div class="form-group">
		<div class="row">
			<div class="col-md-12"><label>Position : </label>
			<input name="name" type="text" class="form-control"  placeholder="Position">
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-md-12"><label >No. of can run</label>
		<input name="limit" type="number" class="form-control" placeholder="No. of candidate that can run">
	</div>
</div>
</div>
<input type="submit" value="Add this position" class="text-capitalize pull-right btn btn-primary">
</form>
@endsection
