@include('admin.templates.header')
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="/admin/dashboard" class="site_title"><i class="fa fa-users"></i> <span>Voting system</span></a>
						</div>
						<div class="clearfix"></div>
						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="{{ URL::asset('images/' .  $admin->profile ) }}" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2>{{ $admin->lastname . ', ' .  $admin->firstname }}</h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->
						<br />
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<h3>General</h3>
								<ul class="nav side-menu">
									<li><a href="/admin/dashboard" class="text-capitalize"><i class="fa fa-dashboard"></i>Dashboard</a></li>
										<li><a><i class="fa fa-table"></i>Students<span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li><a href="/admin/students" class="text-capitalize"><i class="fa fa-user"></i>Students</a></li>
												<li><a href="/admin/students/import" class="text-capitalize"><i class="fa fa-users"></i>Import</a></li>
											</ul>
										</li>
									@if ($voting_state === 'closed')
									<li><a><i class="fa fa-users"></i> Candidates <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="/admin/candidate/create" class="text-capitalize">add new candidates</a></li>
										<li><a href="/admin/candidates">Candidates</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-table"></i>Positions<span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">
									<li><a href="/admin/position/create" class="text-capitalize">add new position</a></li>
									<li><a href="/admin/positions" class="text-capitalize">positions</a></li>
								</ul>
							</li>
							@else
							<li>
								<a>
									<i class="fa fa-bar-chart-o"></i>Voting<span class="fa fa-chevron-down"></span>
								</a>
								<ul class="nav child_menu">
									<li><a href="/admin/voting">View (in Real time)</a></li>
									<li><a href="/admin/candidates/rank">View Ranks</a></li>
								</ul>
							</li>
							@endif


					</ul>
				</div>
			</div>
			<!-- /sidebar menu -->
		</div>
	</div>
	<!-- top navigation -->
	<div class="top_nav">
		<div class="nav_menu">
			<nav>
				<div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="">
						<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<img src="{{ URL::asset('images/' .  $admin->profile ) }}" alt="">{{ $admin->lastname . ', ' . $admin->firstname }}
							<span class=" fa fa-angle-down"></span>
						</a>
						<ul class="dropdown-menu dropdown-usermenu pull-right">
							<li><a href="/admin/profile"> Settings</a></li>
							<li><a href="/admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- /top navigation -->
	<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3 class="text-capitalize">{{ $title }}</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /page content -->
<!-- footer content -->
<footer>
<div class="pull-right">
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<script src="{{ URL::asset('/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('fastclick/lib/fastclick.js') }}"></script>
<script src="{{ URL::asset('nprogress/nprogress.js') }}"></script>
<script src="{{ URL::asset('js/custom.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/jquery.amaran/0.5.4/jquery.amaran.min.js"></script>
	@if ($voting_state === 'open')
		<script src="{{ URL::asset('trackvotes.js') }}"></script>
	@endif
</body>
</html>
