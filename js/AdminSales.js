$(document).ready(function() {

	var url = window.location.pathname.split("/").pop();

	var salesDataTable = $('#salesList').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [ 0, 'asc' ],
		"ajax": {
			url:"action.php",
			type:"POST",
			data:{action:'adminGetSupplierList'}
		},
        "columnDefs":[
            {
                "targets":[3, 4],
                "orderable":false,
            },
        ],
		"pageLength": 10
	});

	//get staff info in dialog when clicking 'update'
	$(document).on('click', '.update', function(){
        var cid = $(this).attr("id");
        var btn_action = 'getSalesDetail';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{cid:cid, btn_action:btn_action},
            dataType:"json",
            success:function(data){
                $('#staffModal').modal('show');
                $('#sname').val(data.staff_name);
                $('#cid').val(cid);
                $('#stype').val(data.staff_type);
                $('#sinit').val(data.staff_init);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Staff");
                $('#action').val("Edit");
                $('#btn_action').val("updateStaff");
            }
        })
    });

	//action when clicking 'delete'
	$(document).on('click', '.delete', function(){
        var cid = $(this).attr("id");
        var btn_action = 'toggleStaffStatus';
        if(confirm("Deactivating staff will make it invisible in staff list, confirm?")) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{cid:cid, btn_action:btn_action},
                success:function(data){
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    staffDataTable.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });	

    //add new staff
	$('#addSales').click(function(){
        $('#staffModal').modal('show');
        $('#editForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Staff");
        $('#action').val("Add");
        $('#btn_action').val("addSales");
    });

	//Edit staff
    $(document).on('submit', '#editForm', function(event){
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"action.php",
            method:"POST",
            data:formData,
            success:function(data) {
                $('#editForm')[0].reset();
                $('#staffModal').modal('hide');
                $('#action').attr('disabled', false);
                staffDataTable.ajax.reload();
            }
        })
    });

/*    var myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
    $(document).on('keyup',function(evt) {
        if (evt.keyCode == 27) {
            myModal.hide();
        }   
      });
*/

} );