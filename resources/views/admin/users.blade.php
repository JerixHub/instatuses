@extends('admin.layout.layout')

@section('title')
Users Masterlist - BHIMS
@endsection

@section('sidenav')
<li class="nav-item">
	<a class="nav-link" href="/admin">
		<i class="material-icons">dashboard</i>
		<p>Dashboard</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/analytics">
		<i class="material-icons">person</i>
		<p>Analytics</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/reports">
		<i class="material-icons">content_paste</i>
		<p>Reports</p>
	</a>
</li>
<li class="nav-item active">
	<a class="nav-link" href="/admin/users">
		<i class="material-icons">library_books</i>
		<p>Users Masterlist</p>
	</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/admin/settings">
		<i class="material-icons">bubble_chart</i>
		<p>Settings</p>
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
						<div class="dropdown-divider"></div>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
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
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">people</i>
					</div>
					<p class="card-category">Registered Users</p>
					<h3 class="card-title">{{ count($users) }}</h3>
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
						<i class="material-icons">check_circle_outline</i>
					</div>
					<p class="card-category">Verified Users</p>
					<h3 class="card-title">{{ count($verified) }}</h3>
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
					<p class="card-category">Unverified Users</p>
					<h3 class="card-title">{{ count($users) - count($verified) }}</h3>
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
				<div class="card-header card-header-warning card-header-icon">
					<div class="card-icon">
						<i class="material-icons">person</i>
					</div>
					<p class="card-category">Daily Registrants</p>
					<h3 class="card-title">{{ count($daily_registrants) }}</h3>
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
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="/admin/users/create" class="btn btn-info">
						<i class="material-icons">person_add</i> Add New User
					</a>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Fullname</th>
								<th>Email</th>
								<th>Barangay</th>
								<th>Verified</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								@if($user->id == 1)
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
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->barangay_id }}</td>
										<td>
											@if($user->is_verified == 1)
												Yes
											@else
												No
											@endif
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
								@else
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
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->barangay->name }}</td>
										<td>
											@if($user->is_verified == 1)
												Yes
											@else
												No
											@endif
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
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection