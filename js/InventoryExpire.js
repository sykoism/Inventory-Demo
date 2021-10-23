$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	$('#dateDropDownList').on("change", function () {  
		var myParam = $('#dateDropDownList').val();
			// Table with ajax
		var expiryDataTable = $('#expireList').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [ 0, 'asc' ],
			"ajax": {
				url:"action.php",
				type:"POST",
				data:{expireDay:myParam, action:'getExpireList'}
			}, 
			"destroy": true,
			"pageLength": 10,
		});
	});



} );