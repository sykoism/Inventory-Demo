$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	var specDataTable = $('#specList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'asc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'getSpecList'}
		},
		"pageLength": 10
	});
} );