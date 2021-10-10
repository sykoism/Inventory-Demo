<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>


<?php include('inc/container.php');?>



<h2>Under Contruction</h2>
		
	

<?php include('inc/footer.php');?>
