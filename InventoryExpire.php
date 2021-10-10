<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/dataTables.dateTime.min.js"></script>
<script src="js/InventoryExpire.js"></script>


<?php include('inc/container.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Inventory Filtered By Expiry Date</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
						<table border="0" cellspacing="5" cellpadding="5">
        				<tbody><tr>
            				<td>Minimum date:</td>
            				<td><input type="text" id="min" name="min"></td>
        				</tr>
        				<tr>
            				<td>Maximum date:</td>
            				<td><input type="text" id="max" name="max"></td>
        				</tr>
    					</tbody></table>
							<table id="expireList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Equipment Name</th>										
										<th>Lot Number</th>
										<th>Expiry Date</th>
										<th>Inventory on Hand</th>	
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>	
</div>	
	

<?php include('inc/footer.php');?>