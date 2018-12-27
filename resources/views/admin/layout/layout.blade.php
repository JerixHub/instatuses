<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('img/download.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- Material Dashboard CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css') }}">

</head>
<body>
	
	<div class="wrapper">
		<div class="sidebar" data-color="green" data-background-color="white">
			<div class="logo">
				<a href="/admin" class="simple-text logo-normal">Department of Health</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					@yield('sidenav')
				</ul>
			</div>
		</div>
		<div class="main-panel">
			@yield('navbar')
			<div class="content">
				@yield('content')

				<footer class="footer">
					<div class="container-fluid">
						<nav class="float-left">
							<ul>
								<li>
									<a href="#">
										BHIMS
									</a>
								</li>
								<li>
									<a href="#">
										About Us
									</a>
								</li>
								<li>
									<a href="#">
										Contact Us
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright float-right">
							&copy;
							<script>
								document.write(new Date().getFullYear())
							</script>, made with <i class="material-icons">favorite</i> by
							<a href="#" target="_blank">Tag's Creative.</a>
						</div>
					</div>
				</footer>
			</div>
		</div>

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>

<!-- Plugin for the Perfect Scrollbar -->
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

<!-- Plugin for the momentJs  -->
<script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.js') }}"></script>

<!-- Forms Validations Plugin -->
<script src="{{ asset('assets/js/plugins/jquery.validate.min.js') }}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}" ></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js') }}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('assets/js/plugins/jquery-jvectormap.js') }}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" ></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->
<script src="{{ asset('assets/js/plugins/arrive.min.js') }}"></script>

<!--  Google Maps Plugin    -->
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyYM0wdvmHA5KRhEAl1R7rMp28eCHoGlo"></script>

<!-- Chartist JS -->
<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/material-dashboard.min.js') }}" type="text/javascript"></script>

<!-- Main JS -->
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>