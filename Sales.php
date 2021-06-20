<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/sales.js"></script>

<link href="css/datatables.min.css" rel="stylesheet">
<script src="js/datatables.min.js"></script>

<?php include('inc/container.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Manage Supplier</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="supplierList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>										
										<th>Name</th>
										<th>Salesperson</th>
										<th>Mobile</th>
										<th>Status</th>	
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