@php $title = 'Login' @endphp
@include('admin.templates.header')
<body class="login">
	<div>
		@if (hasMessage('errors'))
		<div class="alert alert-danger text-center" style="border-radius: 0;" role="alert">
			<strong style="color:#fff;">{{ getFlashMessage('errors') }}</strong>
		</div>
		@php
		flushMessage('errors');
		@endphp
		@endif

		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form method="POST" autocomplete="off">
						<h1>Login your account</h1>
						<div>
							<input type="text" class="form-control" name="username" placeholder="Username" required="" />
						</div>
						<div>
							<input type="password" class="form-control" name="password" placeholder="Password" required="" />
						</div>
						<div>
							<button type="submit" class="btn btn-default submit pull-right">Log in</button>
						</div>
						<div class="clearfix"></div>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>
</html>
