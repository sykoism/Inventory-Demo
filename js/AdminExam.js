$(document).ready(function(){
	
	var examData = $('#adminExamList').DataTable({
		"lengthChange": false,
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"action.php",
            type:"POST",
			data:{action:'getAdminExam'},
			dataType:"json"
        },
        "columnDefs":[
            {
                "targets":[5],
                "orderable":false,
            },
        ],
        "pageLength": 10
    });

    //action when clicking 'delete'
	$(document).on('click', '.delete', function(){
        var accnum = $(this).attr("id");
        var btn_action = 'deleteExam';
        if(confirm("Action cannot be undone. Confirm?")) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{accnum:accnum, btn_action:btn_action},
                success:function(data){
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    staffDataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });	

});