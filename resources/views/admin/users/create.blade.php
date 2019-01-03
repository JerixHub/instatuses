@extends('admin.layout.layout')

@section('title')
Users Masterlist - BHIMS
@endsection

@section('style')
<style>
.user-image-container{
	text-align: center;
}
.user-image-container img{
	max-width: 300px;
}
</style>
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
			<a class="navbar-brand" href="#">Create New User</a>
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
				<div class="card-header card-header-primary">
					<h4 class="card-title">Create New User</h4>
					<p class="card-category">Complete Fields</p>
				</div>
				<div class="card-body">
					<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="user-image-container">
									<img src="/img/default.png" alt="avatar">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<input type="file" class="inputFileHidden" name="image_url" accept="image/x-png,image/gif,image/jpeg" style="display: none;">
								<button type="button" class="inputFileVisible btn btn-info btn-round">Upload</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group bmd-form-group">
									<label class="bmd-label-floating">Fullname</label>
									<input type="text" class="form-control" name="fullname">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group bmd-form-group">
									<label class="bmd-label-floating">Email address</label>
									<input type="email" class="form-control" name="email">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group bmd-form-group">
									<select name="barangay_id" id="barangay_id" class="form-control">
										@foreach($barangays as $barangay)
										<option value="{{ $barangay->id }}">{{$barangay->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3" style="padding-top: 20px;">
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" value="0" name="is_verified">
										Verified
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" value="0" name="is_admin">
										Is Admin
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group bmd-form-group">
									<label>Password</label>
									<div class="input-group">
								        <input type="password" class="form-control" name="password">
								        <span class="input-group-btn">
								            <button type="button" class="btn btn-fab btn-round btn-primary show-password">
								                <i class="fa fa-eye"></i>
								            </button>
								        </span>
								    </div>
								</div>
							</div>
							<div class="col-md-2">
								<button class="generate-password btn btn-info btn-round" type="button">Generate</button>
							</div>
						</div>
						<button type="submit" class="btn btn-primary pull-right">Create</button>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){
		$('.inputFileVisible').on('click', function(){
			$('.inputFileHidden').trigger('click');
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.user-image-container img').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$('.inputFileHidden').on('change', function(){
			readURL(this);
		});

		function makePassword() {
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for (var i = 0; i < 6; i++)
				text += possible.charAt(Math.floor(Math.random() * possible.length));

			return text;
		}

		$('.generate-password').on('click', function(){
			var password = makePassword();
			$('input[name=password]').val(password);
		});

		$('.show-password').on('click', function(){
			var password_type = $('input[name=password]').attr('type');
			if(password_type == 'password'){
				$('input[name=password]').attr('type','text');
				$(this).find('i').removeClass('fa-eye');
				$(this).find('i').addClass('fa-eye-slash');
			}else{
				$('input[name=password]').attr('type', 'password');
				$(this).find('i').addClass('fa-eye');
				$(this).find('i').removeClass('fa-eye-slash');
			}
		});
	});
</script>
@endsection