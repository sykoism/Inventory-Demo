<?php 
session_start();
include('inc/header.php');
include 'Inventory.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>


<?php include('inc/container.php');?>

<div class="container">		
	<?php include("menus.php"); ?>   
	
	<div">
  <h2>Under Contruction</h2>
	</div>
		
</div>	

<?php include('inc/footer.php');?>
