$(document).ready(function() {

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


    } );