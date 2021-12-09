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
        "columnDefs":[
            {
                "targets":[3, 4],
                "orderable":false,
            },
        ],
		"pageLength": 10
	});

	//get staff info when clicking 'update'
	$(document).on('click', '.update', function(){
        var sid = $(this).attr("id");
        var btn_action = 'getStaffDetail';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{sid:sid, btn_action:btn_action},
            dataType:"json",
            success:function(data){
                $('#staffModal').modal('show');
                $('#sname').val(data.staff_name);
                $('#sid').val(sid);
                $('#stype').val(data.staff_type);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Staff");
                $('#action').val("Edit");
                $('#btn_action').val("updateStaff");
            }
        })
    });

	//action when clicking 'delete'
	$(document).on('click', '.delete', function(){
        var sid = $(this).attr("id");
        var btn_action = 'toggleStaffStatus';
        if(confirm("Are you sure you want to delete this staff?")) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{sid:sid, btn_action:btn_action},
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
	$('#addProduct').click(function(){
        $('#productModal').modal('show');
        $('#productForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Product");
        $('#action').val("Add");
        $('#btn_action').val("addProduct");
    });

	//Edit staff
    $(document).on('submit', '#productForm', function(event){
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"action.php",
            method:"POST",
            data:formData,
            success:function(data) {
                $('#productForm')[0].reset();
                $('#productModal').modal('hide');
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