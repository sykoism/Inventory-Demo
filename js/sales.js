$(document).ready(function(){
    var url = window.location.pathname.split("/").pop();

    var supplierDataTable = $('#supplierList').DataTable({
		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'supplierList'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"target":[4,5],
				"orderable":false
			}
		],
		"pageLength": 25
	});

});