<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>

<script src="js/AdminExam.js"></script>

<?php include('inc/container_admin.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Sales Contact</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="adminExamList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Exam Date</th>									
										<th>Patient ID</th>
										<th>Accession Number</th>
										<th>Patient Name</th>
										<th>Exam Type</th>
                                        <th>Delete</th>
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