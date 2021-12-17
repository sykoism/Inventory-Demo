$(document).ready(function() {
    //get accession number in URL
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('acc_id');

    //return accession number to form
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
            $('#btn_action').val("updateExamInfo");
        }
    })

    $(document).on('submit', '#currentExamInfo', function(event){
        event.preventDefault();
        //set action's attribute to disabled
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url:"action.php",
            method:"POST",
            data:formData,
            success:function(data) {
                $('#currentExamInfo')[0].reset();
                $('#action').attr('disabled', false);
                window.location.reload();
            },
            error: function (XMLHttpRequest) {
                console.log(XMLHttpRequest.responseText);
            }
        })
    });

    //function of adding rows for inventory
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

    //enter the barcode, and then show the data of equipment
    /*$(document).on('change', '#categoryid', function(){	
        var categoryid = $('#categoryid').val();		
        var btn_action = 'getCategoryBrand';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{categoryid:categoryid, btn_action:btn_action},
            success:function(data) {				
                $('#brandid').html(data);
            }
        });
    });
    */

} );