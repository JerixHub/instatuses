@extends('admin.layout.layout')

@section('title')
Dashboard - BHIMS
@endsection

@section('sidenav')
<li class="nav-item active">
	<a class="nav-link" href="/admin">
		<i class="material-icons">person</i>
		<p>Analytics</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" data-toggle="collapse" href="#reporting" aria-expanded="true">
		<i class="material-icons">content_paste</i>
		<p> Reports
			<b class="caret"></b>
		</p>
	</a>
	<div class="collapse" id="reporting">
		<ul class="nav">
			<li class="nav-item ">
				<a class="nav-link" href="#tclreporting" data-toggle="collapse" aria-expanded="true">
					<i class="material-icons">list</i>
					<p> Target Client List
						<b class="caret"></b>
					</p>
				</a>
				<div class="collapse" id="tclreporting">
					<ul class="nav">
						<li class="nav-item">
							<a href="/admin/targets" class="nav-link">
								<span class="sidebar-mini">P1</span>
								<span class="sidebar-normal">Part 1</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<span class="sidebar-mini">P2</span>
								<span class="sidebar-normal">Part 2</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="#summaryreporting" data-toggle="collapse" aria-expanded="true">
					<i class="material-icons">show_chart</i>
					<p> Summary Table
						<b class="caret"></b>
					</p>
				</a>
				<div class="collapse" id="summaryreporting">
					<ul class="nav">
						@foreach($programs as $program)
						<li class="nav-item">
							<a href="{{URL::route('show.current.program', [$program->id, Auth::user()->barangay, Auth::user()->id])}}" class="nav-link">
								<span class="sidebar-normal">{{ $program->name }}</span>
							</a>
						</li>
						@endforeach
					</ul>
				</div>
			</li>
		</ul>
	</div>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/users">
		<i class="material-icons">library_books</i>
		<p>Users Masterlist</p>
	</a>
</li>
@if(Auth::user()->is_superadmin)
<li class="nav-item">
	<a class="nav-link" href="/admin/questions">
		<i class="material-icons">contact_support</i>
		<p>Questions Masterlist</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/programs">
		<i class="material-icons">apps</i>
		<p>Programs Masterlist</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/program-questions">
		<i class="material-icons">code</i>
		<p>Program Answers</p>
	</a>
</li>
@endif
<li class="nav-item">
	<a class="nav-link" href="/admin/settings">
		<i class="material-icons">bubble_chart</i>
		<p>Settings</p>
	</a>
</li>
<li class="nav-item">
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
	<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		<i class="material-icons">arrow_back</i>
		<p>Logout</p>
	</a>
</li>
@endsection

@section('navbar')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
	<div class="container-fluid">
		<div class="navbar-wrapper">
			<a class="navbar-brand" href="#">Dashboard</a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="sr-only">Toggle navigation</span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end">
			<form class="navbar-form">
				<div class="input-group no-border">
					<input type="text" value="" class="form-control" placeholder="Search...">
					<button type="submit" class="btn btn-white btn-round btn-just-icon">
						<i class="material-icons">search</i>
						<div class="ripple-container"></div>
					</button>
				</div>
			</form>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#pablo">
						<i class="material-icons">dashboard</i>
						<p class="d-lg-none d-md-block">
							Stats
						</p>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="material-icons">notifications</i>
						<span class="notification">5</span>
						<p class="d-lg-none d-md-block">
							Some Actions
						</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Mike John responded to your email</a>
						<a class="dropdown-item" href="#">You have 5 new tasks</a>
						<a class="dropdown-item" href="#">You're now friend with Andrew</a>
						<a class="dropdown-item" href="#">Another Notification</a>
						<a class="dropdown-item" href="#">Another One</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="material-icons">person</i>
						<p class="d-lg-none d-md-block">
							Account
						</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
						<a class="dropdown-item" href="#">Profile</a>
						<a class="dropdown-item" href="#">Settings</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- End Navbar -->
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-warning card-header-icon">
					<div class="card-icon">
						<i class="material-icons">content_copy</i>
					</div>
					<p class="card-category">Used Space</p>
					<h3 class="card-title">49/50
						<small>GB</small>
					</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-danger">warning</i>
						<a href="#pablo">Get More Space...</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">store</i>
					</div>
					<p class="card-category">Revenue</p>
					<h3 class="card-title">$34,245</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">date_range</i> Last 24 Hours
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-danger card-header-icon">
					<div class="card-icon">
						<i class="material-icons">info_outline</i>
					</div>
					<p class="card-category">Fixed Issues</p>
					<h3 class="card-title">75</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">local_offer</i> Tracked from Github
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="fa fa-twitter"></i>
					</div>
					<p class="card-category">Followers</p>
					<h3 class="card-title">+245</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons">update</i> Just Updated
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card card-chart">
				<div class="card-header card-header-success">
					<div class="ct-chart" id="dailySalesChart"></div>
				</div>
				<div class="card-body">
					<h4 class="card-title">Daily Sales</h4>
					<p class="card-category">
						<span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">access_time</i> updated 4 minutes ago
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-chart">
					<div class="card-header card-header-warning">
						<div class="ct-chart" id="websiteViewsChart"></div>
					</div>
					<div class="card-body">
						<h4 class="card-title">Email Subscriptions</h4>
						<p class="card-category">Last Campaign Performance</p>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">access_time</i> campaign sent 2 days ago
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-chart">
					<div class="card-header card-header-danger">
						<div class="ct-chart" id="completedTasksChart"></div>
					</div>
					<div class="card-body">
						<h4 class="card-title">Completed Tasks</h4>
						<p class="card-category">Last Campaign Performance</p>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">access_time</i> campaign sent 2 days ago
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="card">
					<div class="card-header card-header-tabs card-header-primary">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<span class="nav-tabs-title">Tasks:</span>
								<ul class="nav nav-tabs" data-tabs="tabs">
									<li class="nav-item">
										<a class="nav-link active" href="#profile" data-toggle="tab">
											<i class="material-icons">bug_report</i> Bugs
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#messages" data-toggle="tab">
											<i class="material-icons">code</i> Website
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#settings" data-toggle="tab">
											<i class="material-icons">cloud</i> Server
											<div class="ripple-container"></div>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active" id="profile">
								<table class="table">
									<tbody>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="" checked>
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Sign contract for "What are conference organizers afraid of?"</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="">
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="">
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="" checked>
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Create 4 Invisible User Experiences you Never Knew About</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="messages">
								<table class="table">
									<tbody>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="" checked>
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="">
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Sign contract for "What are conference organizers afraid of?"</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="settings">
								<table class="table">
									<tbody>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="">
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="" checked>
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
											</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="" checked>
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</td>
											<td>Sign contract for "What are conference organizers afraid of?"</td>
											<td class="td-actions text-right">
												<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
													<i class="material-icons">edit</i>
												</button>
												<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
													<i class="material-icons">close</i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card">
					<div class="card-header card-header-warning">
						<h4 class="card-title">Employees Stats</h4>
						<p class="card-category">New employees on 15th September, 2016</p>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-hover">
							<thead class="text-warning">
								<th>ID</th>
								<th>Name</th>
								<th>Salary</th>
								<th>Country</th>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Dakota Rice</td>
									<td>$36,738</td>
									<td>Niger</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Minerva Hooper</td>
									<td>$23,789</td>
									<td>Curaçao</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Sage Rodriguez</td>
									<td>$56,142</td>
									<td>Netherlands</td>
								</tr>
								<tr>
									<td>4</td>
									<td>Philip Chaney</td>
									<td>$38,735</td>
									<td>Korea, South</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
