$(document).ready(function(){
	$('#minimizeSidebar').on('click', function(){
		$('body').toggleClass('sidebar-mini');
	});

	$('.datetimepicker').datetimepicker();
});