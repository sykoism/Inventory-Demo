var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[4] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	// Create date inputs
	minDate = new DateTime($('#min'), {
		format: 'YYYY-MM-DD'
	});
	maxDate = new DateTime($('#max'), {
		format: 'YYYY-MM-DD'
	});

	// Table with ajax
	var supplierDataTable = $('#expireList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'asc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'getExpireList'}
		},
		"pageLength": 10
	});
} );