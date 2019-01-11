@extends('admin.layout.layout')

@section('title')
{{ $current_program->name }} Summary
@endsection

@section('sidenav')
<li class="nav-item active">
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
							<a href="#" class="nav-link">
								<!-- <span class="sidebar-mini">1st</span> -->
								<span class="sidebar-normal">Part 1</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<!-- <span class="sidebar-mini">2nd</span> -->
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
						@foreach($summaries as $summary)
						<li class="nav-item">
							<a href="{{URL::route('show.program.barangay', [$summary->program->id, Auth::user()->barangay, Auth::user()->id])}}" class="nav-link">
								<span class="sidebar-normal">{{ $summary->program->name }}</span>
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
			<a class="navbar-brand" href="/admin/summary/{{ $current_program->id }}/{{ $current_barangay->id }}/{{ Auth::user()->id }}">{{ $current_program->name }} Summary</a>
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
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">
						{{$current_program->name}}
					</h4>
				</div>
				<div class="card-body">
					<div class="material-datatables">
						<table id="datatables" class="table table-striped table-no-bordered table-hover">
							<thead>
								<tr>
									<th rowspan="2">Indicators</th>
									@foreach($dates as $date)
									<th colspan="3">{{$date}}</th>
									@endforeach
								</tr>
								<tr>
									@foreach($dates as $date)
									<th>M</th>
									<th>F</th>
									<th>T</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								@foreach($current_program->questions as $question)
								<tr>
									<td>{{$question->name}}</td>
									@foreach($dates as $date)
									<td>0</td>
									<td>0</td>
									<td>0</td>
									@endforeach
								</tr>
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