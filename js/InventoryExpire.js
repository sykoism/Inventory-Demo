$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	new DateTime(document.getElementById('min'), {
        buttons: {
            today: true,
            clear: true
		}
	});

	new DateTime(document.getElementById('max'), {
        buttons: {
            today: true,
            clear: true	
		}	
	});



	// Table with ajax
	var expiryDataTable = $('#expireList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'asc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'getExpireList'}
		}, 
		"pageLength": 10,
	});

} );