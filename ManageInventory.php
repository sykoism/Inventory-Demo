<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/ManageInventory.js"></script>


<?php include('inc/container.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Manage Inventory</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="inventoryList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Equipment ID</th>										
										<th>Equipment Name</th>
                                        <th>Supplier</th>
										<th>Expiry Date</th>
										<th>Inventory On Hand</th>
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

<!--Total number of inventory filtered here-->

<?php include('inc/footer.php');?>