<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
$inventory->checkAdmin();
?>

<script src="js/AdminSales.js"></script>

<?php include('inc/container_admin.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="d-flex bd-highlight mb-3">
					<div class="p-2 bd-highlight">
							<h3 class="panel-title">Manage sales</h3>
					</div>
					<div class="d-flex justify-content-end">
                        <button type="button" name="add" id="addSales" class="btn btn-success btn-xs">Add</button>
                    </div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="salesList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>	
										<th>Name</th>										
										<th>Salesperson</th>
										<th>Mobile</th>
										<th>Status</th>
										<th>Modify</th>
                                        <th>Activate/Inactivate</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	<!-- Modal -->
	<div id="staffModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="editForm">
                    <div class="modal-content">
                        <div class="modal-header">
							<h4 class="modal-title">Modal title</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
                            <div class="form-group">
                                <label>Company ID</label>
                                <input type="number" name="cid" id="cid" class="form-control" required />
                            </div>
							<div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="cname" id="cname" class="form-control" required />
                            </div>
							<div class="form-group">
                                <label>Salesperson</label>
                                <input type="text" name="salesperson" id="salesperson" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="number" name="phone" id="phone" class="form-control" required />
                            </div>
						</div>
						<div class="modal-footer">
                            <!--<input type="hidden" name="sid" id="sid" />-->
                            <input type="hidden" name="btn_action" id="btn_action" />
                            <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
					</div>
				</form>
			</div>
	</div>
								
</div>	



<?php include('inc/footer.php');?>