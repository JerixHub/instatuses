@extends('admin.layout.layout')

@section('title')
Questions Masterlist
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
<li class="nav-item active">
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
        <div class="navbar-minimize">
			<button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
				<i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
				<i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
				<div class="ripple-container"></div>
            </button>
		</div>
		<div class="navbar-wrapper">
			<a class="navbar-brand" href="#">Questions Masterlist</a>
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/admin/targets/create" class="btn btn-info">
						<i class="material-icons">face</i> Add New Client
					</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="text-info">
                                <tr>
                                    <th rowspan="2">Date of Registration</th>
                                    <th rowspan="2">Date of Birth</th>
                                    <th rowspan="2">Family Serial Number</th>
                                    <th rowspan="2">NHTS</th>
                                    <th rowspan="2">Name of Child</th>
                                    <th rowspan="2" class="verticalTableHeader"><p>Weight</p></th>
                                    <th rowspan="2" class="verticalTableHeader"><p>Length/Height</p></th>
                                    <th rowspan="2">Sex</th>
                                    <th rowspan="2">Mother's Name</th>
                                    <th rowspan="2">Address</th>
                                    <th colspan="2">Date Newborn Screening</th>
                                    <th colspan="2">Child Protect at Birth</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                	<th>Referrarl</th>
                                	<th>Done</th>
                                	<th>TT Status</th>
                                	<th>Date Assessed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                	<td>1-16-16</td>
                                	<td>1-15-16</td>
                                	<td>322</td>
                                	<td></td>
                                	<td>Nathan Avery Destajo</td>
                                	<td class="text-center">8</td>
                                	<td class="text-center">50</td>
                                	<td>M</td>
                                	<td>Ivy Cator</td>
                                	<td>P1 Rizal Diez</td>
                                	<td>1-15-16</td>
                                	<td>1-18-16</td>
                                	<td></td>
                                	<td>1-15-16</td>
                                </tr>
                                <tr>
                                	<td>1-16-16</td>
                                	<td>1-15-16</td>
                                	<td>322</td>
                                	<td></td>
                                	<td>Nathan Avery Destajo</td>
                                	<td class="text-center">8</td>
                                	<td class="text-center">50</td>
                                	<td>M</td>
                                	<td>Ivy Cator</td>
                                	<td>P1 Rizal Diez</td>
                                	<td>1-15-16</td>
                                	<td>1-18-16</td>
                                	<td></td>
                                	<td>1-15-16</td>
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

@section('script')
<script>
    $(document).ready(function(){
        $('.destroy-question').on('click', function(){
            var id = $(this).data('id');
            var token = $(this).data('token');
            var dom = $(this).closest('tr');
            swal({
                title:"Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#26c6da',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        url: "/admin/questions/"+id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "_method": "DELETE",
                            "_token": token,
                        },
                        success: function(data)
                        {
                            swal({
                                title: 'Deleted!',
                                text: data['success'],
                                type: 'success',
                                timer: 1500
                            });
                            dom.fadeOut();
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
