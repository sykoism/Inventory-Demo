<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>


<?php include('inc/container.php');?>



<h2>Here is an Inventory Management System developed by Ken Koo.</h2>
<br>
<h4>You can try every function and give me the feedback!</h4>
		
<br>
<h4>A dashboard here to show current error in inventory e.g. negative stock.</h4>	

<?php include('inc/footer.php');?>
