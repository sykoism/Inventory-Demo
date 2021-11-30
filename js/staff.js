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
		"pageLength": 10
	});

	//get staff info when clicking 'update'
	$(document).on('click', '.update', function(){
        var pid = $(this).attr("id");
        var btn_action = 'getProductDetails';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{pid:pid, btn_action:btn_action},
            dataType:"json",
            success:function(data){
                $('#productModal').modal('show');
                $('#categoryid').val(data.categoryid);
                $('#brandid').html(data.brand_select_box);
                $('#brandid').val(data.brandid);
                $('#pname').val(data.pname);
				$('#pmodel').val(data.model);
                $('#description').val(data.description);
                $('#quantity').val(data.quantity);
                $('#unit').val(data.unit);
                $('#base_price').val(data.base_price);
                $('#tax').val(data.tax);
				$('#supplierid').val(data.supplier);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Product");
                $('#pid').val(pid);
                $('#action').val("Edit");
                $('#btn_action').val("updateProduct");
            }
        })
    });

	//action when clicking 'delete'
	$(document).on('click', '.delete', function(){
        var pid = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = 'deleteProduct';
        if(confirm("Are you sure you want to delete this staff?")) {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{pid:pid, status:status, btn_action:btn_action},
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


} );