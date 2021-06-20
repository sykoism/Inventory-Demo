$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	var supplierDataTable = $('#supplierList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'supplierList'}
		},

		"pageLength": 25
	});
} );