$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('acc_id');
    document.getElementById('acc_num').value = myParam;
    $.ajax({
        url:"action.php",
        method:"POST",
        data:{acc_num:myParam, action:'getExamInfo'},
        dataType:"json",
        success:function(data){
            $('#pat_id').val(data.PatientID);
            $('#name').val(data.PatientName);
            $('#examID').val(data.ExamID);
            $('#pher').val(data.Radiographer);
            $('#gist').val(data.Radiologist);
            $('#nurse').val(data.Nurse);
            $('#action').val("Save");
            $('#btn_action').val("updateExam");
        }
    })

    //auto add rows for inventory
    var t = $('#example').DataTable({
        "pageLength": 50,
        columnDefs: [{
            orderable: false,
            targets: [1,2,3]
        }]
    });
    var counter = 1;
 
    $('#addRow').on( 'click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );
 
        counter++;
    } );
 
    // Automatically add a first row of data
    $('#addRow').click();

} );