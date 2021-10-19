<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>


<?php include('inc/container_admin.php');?>



<h2>Admin Page gets extra function like adding inventory.</h2>
		
	

<?php include('inc/footer.php');?>
