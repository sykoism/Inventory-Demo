<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>

<script src="js/addInventory.js"></script>

<?php include('inc/container_admin.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
            <button id="addRow">Add new row</button>
    					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
                			<th>Column 1</th>
                			<th>Column 2</th>
                			<th>Column 3</th>
                			<th>Column 4</th>
                			<th>Column 5</th>
            			</tr>
        				</thead>
						<tfoot>
							<tr>
								<th>Column 1</th>
								<th>Column 2</th>
								<th>Column 3</th>
								<th>Column 4</th>
								<th>Column 5</th>
							</tr>
						</tfoot>
    					</table>
		</div>	
	</div>
								
</div>	
<!--Barcode input-->


<?php include('inc/footer.php');?>