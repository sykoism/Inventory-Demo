$(document).ready(function(){

    //$('#addNewExam').click(function(){
    //    $('#action').val("Add");
    //    $('#btn_action').val("addNewExam");
    //});

    $(document).on('submit', '#newExamForm', function(event){
        event.preventDefault();
        //set action's attribute to disabled
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"action.php",
            method:"POST",
            data:formData,
            success:function(data) {
                $('#newExamForm')[0].reset();
                $('#action').attr('disabled', false);
                //alert('New Study created successfully.');
                //$(location).prop('href', 'EditExam.php?acc_id=');
            }
        })
    });
});