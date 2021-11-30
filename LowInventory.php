<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>


<?php include('inc/container_admin.php');?>



<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">You may set threshold here so that number of inventory appears <span style="color:#ff0000;"> RED </span> when lower than specific threshold.</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="staffList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Inventory Name</th>										
										<th>Threshold</th>
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