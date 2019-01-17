@extends('admin.layout.layout')

@section('title')
Programs Masterlist
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
<li class="nav-item active">
	<a class="nav-link" href="/admin/programs">
		<i class="material-icons">apps</i>
		<p>Programs Masterlist</p>
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
			<a class="navbar-brand" href="#">Programs Masterlist</a>
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
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <h4 class="card-title">Program Form</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('programs.store') }}" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Program Name</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="text" class="form-control" name="name">
                                    <span class="bmd-help">Name of the program i.e. Feeding Program</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Barangay</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <select class="form-control" data-style="btn btn-link" name="barangay">
                                        @foreach($barangays as $barangay)
                                        <option value="{{$barangay->id}}">{{$barangay->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label label-checkbox">Header Type</label>
                            <div class="col-sm-10 checkbox-radios">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="header_type" value="date"> Date
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="header_type" value="age_monthly"> Age By Month
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="header_type" value="age_yearly"> Age by Year
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="header_type" value="quarterly"> Quarterly
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label label-checkbox">Other Options</label>
                            <div class="col-sm-10 checkbox-radios">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="with_gender"> With Gender
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="with_trans"> With Transgender
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="with_target"> With Target
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="with_total"> With Total
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="with_icd_code"> With ICD CODE
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Questionnaires</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <select multiple class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="questions[]">
                                        @foreach($questions as $question)
                                        <option value="{{$question->id}}">{{$question->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection