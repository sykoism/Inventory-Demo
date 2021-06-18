<nav class="navbar navbar-inverse" style="background-color:#1f607d;">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand" id="index_menu">Home</a>
		</div>
		<ul class="nav navbar-nav menus">		
			<li><a href="NewExam.php" id="NewExam_menu">New Exam</a></li>
			<li><a href="CurrentExam.php" id="CurrentExam_menu">Current Exam</a></li>
			<li><a href="EditExam.php" id="EditExam_menu">Previous Exam</a></li>
			<li><a href="Sales.php" id="Sales_menu">Sales Contact</a></li>
			<li><a href="AddInventory.php" id="AddInventory_menu">Add Inventory</a></li>
			<li><a href="ManageInventory.php" id="ManageInventory_menu">Manage Inventory</a></li>
			<li><a href="InventoryExpire.php" id="InventoryExpire.php_menu">Inventory Nearly Expired</a></li>
			<li><a href="order.php" id="order_menu">Orders</a></li>			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> 
				<?php echo $_SESSION['username']; ?></a>
				<ul class="dropdown-menu">
					<li><a href="action.php?action=logout">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
