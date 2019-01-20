@extends('admin.layout.layout')

@section('title')
{{$current_program->name}}
@endsection

@section('sidenav')
<li class="nav-item">
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
	<div class="collapse show" id="reporting">
		<ul class="nav">
			<li class="nav-item">
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
								<span class="sidebar-normal">Part 1</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<span class="sidebar-normal">Part 2</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#summaryreporting" data-toggle="collapse" aria-expanded="true">
					<i class="material-icons">show_chart</i>
					<p> Summary Table
						<b class="caret"></b>
					</p>
				</a>
				<div class="collapse show" id="summaryreporting">
					<ul class="nav">
						@foreach($programs as $program)
						<li class="nav-item {{request()->is('admin/summary/'.$program->id.'/'.$current_barangay->id.'/'.$current_user->id) ? 'active' : ''}}">
							<a href="{{URL::route('show.current.program', [$program->id, Auth::user()->barangay, Auth::user()->id])}}" class="nav-link">
								<span class="sidebar-mini"> ML </span>
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
		<div class="navbar-minimize">
			<button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
				<i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
				<i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
				<div class="ripple-container"></div>
            </button>
		</div>
			<div class="navbar-wrapper">
				<a class="navbar-brand" href="#">{{ $current_program->name }} Summary</a>
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
			@if(!empty($random_question))
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-rose card-header-icon">
						<div class="card-icon">
							<i class="material-icons">info_outline</i>
						</div>
						<p class="card-category">{{ $random_question->name }}</p>
						<h3 class="card-title">90</h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> January up to now
						</div>
					</div>
				</div>
			</div>
			@endif
			@if($current_program->with_gender)
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-info card-header-icon">
						<div class="card-icon">
							<i class="fa fa-male"></i>
						</div>
						<p class="card-category">Total Male</p>
						<h3 class="card-title">34,245</h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> January up to now
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-warning card-header-icon">
						<div class="card-icon">
							<i class="fa fa-female"></i>
						</div>
						<p class="card-category">Total Female</p>
						<h3 class="card-title">75</h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> January up to now
						</div>
					</div>
				</div>
			</div>
			@if($current_program->with_trans)
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-success card-header-icon">
						<div class="card-icon">
							<i class="material-icons">wc</i>
						</div>
						<p class="card-category">Total Transgender</p>
						<h3 class="card-title">245</h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons">date_range</i> January up to now
						</div>
					</div>
				</div>
			</div>
			@endif
			@endif
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-header card-header-warning">
						<h4 class="card-title">{{$current_program->name}} Summary</h4>
						<p class="card-category">For the year {{ date('Y') }}</p>
					</div>
					<div class="card-body table-responsive">
						<div class="material-datatables">
							<table class="table table-striped table-bordered table-hover" id="datatables">
								{!! $header !!}
							<tbody>
								{!! $body !!}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
