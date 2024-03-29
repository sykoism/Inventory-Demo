<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/productinfo.js"></script>

<?php include('inc/container.php');?>

<div class="container">	
    <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-md-10">
                			<h3 class="panel-title">Products Specification</h3>
                		</div>
                	</div>
                </div>
                <div class="panel-body">
                	<table id="specList" class="table table-bordered table-striped">
                		<thead>
							<tr>
								<th>Equipment Model</th>
								<th>Equipment Name</th>
								<th>Equipment Type</th>
							</tr>
						</thead>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php');?>