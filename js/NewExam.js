$(document).ready(function(){

    $('#addNewExam').click(function(){
        $('#newExamForm')[0].reset();
        $('#action').val("Add");
        $('#btn_action').val("addNewExam");
    });
});