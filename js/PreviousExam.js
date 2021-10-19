$(document).ready(function() {
	var url = window.location.pathname.split("/").pop();

	var pExamDataTable = $('#examList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'desc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'getExamList'}
		},
        "columnDefs": [{
            "targets": 2,
            "render": function ( data, type, row, meta ) {
                var itemID = row[2];                   
                return '<a href="/EditExam.php?acc_id=' + itemID + '">' + data + '</a>';
            }
        }],  
		"pageLength": 10
	});
} );