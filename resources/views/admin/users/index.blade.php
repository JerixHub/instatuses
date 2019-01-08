@extends('admin.layout.layout')

@section('title')
Users Masterlist - BHIMS
@endsection

@section('style')
<style>
.user-pagination .page-item.active .page-link{
	border-radius: 50%;
}

.user-pagination .page-link:hover{
	border-radius: 50%;
}
#edit-user-form .form-check.form-check-inline {
	margin-left: 20px;
}
.user-image-container{
	overflow: hidden;
	max-width: 100%;
	max-height: 300px;
	text-align: center;
}
.user-image-container img{
	width: auto;
	max-width: 100%;
}
.approve-form{
	display: inline-block;
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
	<a class="nav-link" data-toggle="collapse" href="#reporting" aria-expanded="true">
		<i class="material-icons">content_paste</i>
		<p> Reports
			<b class="caret"></b>
		</p>
	</a>
	<div class="collapse" id="reporting" style="">
		<ul class="nav">
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/pricing.html">
					<span class="sidebar-mini"> P </span>
					<span class="sidebar-normal"> Pricing </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/rtl.html">
					<span class="sidebar-mini"> RS </span>
					<span class="sidebar-normal"> RTL Support </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/timeline.html">
					<span class="sidebar-mini"> T </span>
					<span class="sidebar-normal"> Timeline </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/login.html">
					<span class="sidebar-mini"> LP </span>
					<span class="sidebar-normal"> Login Page </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/register.html">
					<span class="sidebar-mini"> RP </span>
					<span class="sidebar-normal"> Register Page </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/lock.html">
					<span class="sidebar-mini"> LSP </span>
					<span class="sidebar-normal"> Lock Screen Page </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/user.html">
					<span class="sidebar-mini"> UP </span>
					<span class="sidebar-normal"> User Profile </span>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="../examples/pages/error.html">
					<span class="sidebar-mini"> E </span>
					<span class="sidebar-normal"> Error Page </span>
				</a>
			</li>
		</ul>
	</div>
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
			<a class="navbar-brand" href="#">Users Masterlist</a>
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
	@if(session()->has('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session()->get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if($errors->any())
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
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
					@if(Auth::user()->is_superadmin)
					<a href="/admin/users/create" class="btn btn-info">
						<i class="material-icons">person_add</i> Add New User
					</a>
					@endif
				</div>
				<div class="card-body">
					<table class="table table-shopping">
						<thead>
							<tr>
								<th></th>
								<th>Fullname</th>
								<th>Email</th>
								<th>Contact Number</th>
								<th>Barangay</th>
								<th>Status</th>
								<th>Position</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							@if($user->id != Auth::user()->id && $user->id != 1)
							<tr>
								<td>
									<div class="img-container">
										<img src="{{ $user->image_url ? asset('storage/'.$user->image_url) : '/img/default.png' }}" alt="avatar">
										<input type="hidden" name="image_url" value="{{$user->image_url}}">
									</div>
								</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->contact_no }}</td>
								<td data-id="{{$user->barangay->id}}">{{ $user->barangay->name }}</td>
								<td>
									@if($user->is_verified)
									<i class="material-icons text-success">done</i>
									@else
									<i class="material-icons text-danger">clear</i>
									@endif
								</td>
								<td>{{ $user->is_admin ? 'Admin': 'User' }}</td>
								<td class="td-actions text-right">
									@if(Auth::user()->is_superadmin)
									<button rel="tooltip" title="Edit {{$user->name}}" class="btn btn-primary btn-link btn-sm edit-user" data-toggle="modal" data-target="#editModal" data-id="{{$user->id}}">
										<i class="material-icons">edit</i>
									</button>
									@elseif(Auth::user()->is_admin && $user->is_verified != 1)
									<form action="/admin/users/approve/{{$user->id}}" method="POST" class="approve-form">
										@csrf
										@method('patch')
										<input type="hidden" value="{{$user->id}}" name="user">
										<button class="btn btn-primary btn-link btn-sm approve-user" type="submit" rel="tooltip" title="Approve {{$user->name}}">
											<i class="material-icons">check</i>
										</button>
									</form>
									@else
									<td class="td-actions text-right">
										<button class="btn btn-primary btn-link btn-sm verify-user" rel="tooltip" title="Verify {{$user->name}}" data-id="{{$user->id}}">
											<i class="material-icons">check</i>
										</button>
									</td>
									@endif
									<a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm destroy-user" data-id="{{$user->id}}" data-token="{{ csrf_token() }}">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
					<div class="user-pagination">
						{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@if(Auth::user()->is_superadmin)
<div class="modal fade" id="editModal" tabindex="-1" role="">
	<div class="modal-dialog modal-login" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-body">
					<form class="form" method="POST" action="" id="edit-user-form" enctype="multipart/form-data">
						@csrf
						@method('patch')
						<p class="description text-center">Editing <span class="user-name">Sample User</span></p>
						<div class="card-body">

							<div class="user-image-container">
								<img src="" alt="avatar">
								<input type="hidden" name="image_url_val">
							</div>

							<div class="form-group form-file-upload form-file-simple bmd-form-group">
								<input type="file" class="inputFileHidden" name="image_url" accept="image/x-png,image/gif,image/jpeg">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">attach_file</i></div>
									</div>
									<input type="text" class="form-control inputFileVisible" placeholder="Upload Image">
								</div>
							</div>

							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">face</i></div>
									</div>
									<input type="text" class="form-control" placeholder="Fullname" name="fullname">
								</div>
							</div>

							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">email</i></div>
									</div>
									<input type="text" class="form-control" placeholder="Email" name="email" disabled>
									<input type="hidden" name="email">
								</div>
							</div>

							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">phone</i></div>
									</div>
									<input type="text" class="form-control" placeholder="Contact Number" name="contact_no">
								</div>
							</div>

							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">home</i></div>
									</div>
									<select name="barangay" id="barangay" class="form-control">
										@foreach($barangays as $barangay)
										<option value="{{$barangay->id}}">{{$barangay->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" value="" name="is_verified" value="0">
									Verified
									<span class="form-check-sign">
										<span class="check"></span>
									</span>
								</label>
							</div>

							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" value="" name="is_admin" value="0">
									Is Admin
									<span class="form-check-sign">
										<span class="check"></span>
									</span>
								</label>
							</div>

						</div>
						<button type="submit" class="btn btn-primary btn-success btn-wd edit-submit-btn">Save</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	@endsection

	@section('script')
	<script>
		$(document).ready(function(){
			$('.destroy-user').on('click', function(){
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
							url: "/admin/users/"+id,
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

			$('.edit-user').on('click', function(){
				var name = $(this).closest('tr').find('td:nth-child(2)').text();
				var email = $(this).closest('tr').find('td:nth-child(3)').text();
				var contact_no = $(this).closest('tr').find('td:nth-child(4)').text();
				var barangay = $(this).closest('tr').find('td:nth-child(5)').data('id');
				var is_verified = $(this).closest('tr').find('td:nth-child(6) i');
				var is_admin = $(this).closest('tr').find('td:nth-child(7)').text();
				var image_url_val = $(this).closest('tr').find('td:nth-child(1) input').val();
				var image_url = $(this).closest('tr').find('td:nth-child(1) img').attr('src');
				var id = $(this).data('id');

				$('#editModal #edit-user-form').attr('action','/admin/users/'+id);
				$('#editModal .user-name').text(name);
				$('#editModal input[name=fullname]').val(name);
				$('#editModal input[name=email]').val(email);
				$('#editModal input[name=contact_no]').val(contact_no);
				$('#editModal select[name=barangay]').val(barangay);
				$('#editModal input[name=image_url_val]').val(image_url_val);

				$('.user-image-container img').attr('src', image_url);

				if(is_verified.hasClass('text-success')){
					$('#editModal input[name=is_verified]').prop('checked', true);
				}
				if(is_admin == "Admin"){
					$('#editModal input[name=is_admin]').prop('checked', true);
				}
			});

			$('.inputFileVisible').on('click', function(){
				$(this).closest('.form-group').find('.inputFileHidden').trigger('click');
			});

			$('.inputFileHidden').on('change', function(){
				var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
				$(this).closest('.form-group').find('.inputFileVisible').val(filename);
				readURL(this);
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

		});
	</script>
	@endsection