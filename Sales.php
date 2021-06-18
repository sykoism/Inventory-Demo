<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/sales.js"></script>

<?php include('inc/container.php');?>




		
	

<?php include('inc/footer.php');?>