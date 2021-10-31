$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	var staffDataTable = $('#staffList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'asc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'getStaffList'}
		},
		"pageLength": 10
	});
} );