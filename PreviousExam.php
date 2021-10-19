<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/PreviousExam.js"></script>

<?php include('inc/container.php');?>

<div class="container">	
    <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-md-10">
                			<h3 class="panel-title">List of Previous Exam</h3>
                		</div>
                	</div>
                </div>
                <div class="panel-body">
                	<table id="examList" class="table table-bordered table-striped">
                		<thead>
							<tr>
								<th>Exam Date</th>
								<th>Patient ID</th>
								<th>Accession Number</th>
								<th>Patient Name</th>
								<th>Exam Name</th>
							</tr>
						</thead>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php');?>