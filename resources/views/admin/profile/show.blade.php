@extends('admin.templates.master',[
'title' => ucfirst(last(explode('/',URL::current()))),
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
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
	<div class="profile_img">
		<div id="crop-avatar">
			<img class="img-responsive avatar-view" src="{{ URL::asset('images/' .  $info->profile ) }}" alt="Avatar">
		</div>
	</div>
	<h3 class="text-capitalize">{{ $info->lastname }}, {{ $info->firstname }} {{ substr($info->middlename,0,1) }}. </h3>
	<ul class="list-unstyled user_data">
		<li><h4 class="text-center">Administrator</h4>
		</li>
	</ul>
	<br />
</div>
<div class="col-md-9 col-sm-3 col-xs-12">
	<h3>Update information</h3>
	<hr>
	<form method="POST" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" id="first-name" required="required" name="firstname" value="{{ $info->firstname }}" class="text-capitalize form-control col-md-7 col-xs-12">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" id="last-name"  required="required" name="lastname" value="{{ $info->lastname }}" class="text-capitalize form-control col-md-7 col-xs-12">
	</div>
</div>
<div class="form-group">
	<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input id="middle-name" class="text-capitialize form-control col-md-7 col-xs-12" type="text" name="middlename" value="{{ substr($info->middlename,0,1) }}">
	</div>
</div>
<div class="form-group col-md-9">
	<label class="pull-right col-md-3 col-sm-3 col-xs-3 btn btn-primary" style="border-radius: 0px;" for="profile">Upload profile
	</label>
	<input type="hidden" name="type" value="changeInformation">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input id="profile" name="profile" style="display:none;" class="form-control col-md-7 col-xs-12"  type="file">
	</div>
</div>
<div class="clearfix"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		<input type="submit" class="btn btn-success pull-right" value="Submit">
	</div>
</div>
<div class="ln_solid"></div>
</form>
</div>
<hr>
<div class="col-md-9 col-sm-3 col-xs-12">
	<h3>Update Login credentials</h3>
	<hr>
	<form method="POST" class="form-horizontal form-label-left" autocomplete="off">
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="username" >Username <span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text"  required="required" name="username" id="username" value="{{ $login_info->username }}" class=" form-control col-md-7 col-xs-12">
		</div>
	</div>
<div class="clearfix"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		<input type="hidden" name="type" value="changeUsername">
		<input type="submit" class="btn btn-success pull-right" value="Change username">
	</div>
</div>
</form>
<hr>
<form method="POST" class="form-horizontal form-label-left" autocomplete="off">
	<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password" >Old password <span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" name="password" id="password" class=" form-control col-md-7 col-xs-12">
		</div>
	</div>
	<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="new-password" >New password <span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text"  name="new_password" id="new-password" class=" form-control col-md-7 col-xs-12">
		</div>
	</div>
	<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_new_password" >Re-type new password <span class="required">*</span>
		</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text"   name="confirm_new_password" id="confirm_new_password" class=" form-control col-md-7 col-xs-12">
		</div>
	</div>
<div class="clearfix"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		<input type="hidden" name="type" value="changePassword">
		<input type="submit" class="btn btn-success pull-right" value="Change Password">
	</div>
</div>
</form>
</div>





@endsection
