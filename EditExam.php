<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/EditExam.js"></script>


<?php include('inc/container.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Exam Details</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
                <form method="post" id="currentExamInfo">
    			<div class="modal-content">
    				<div class="modal-body">
                        <div class="form-group">
    					<label>Accession Number</label>
						<input type="text" name="acc_num" id="acc_num" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                        <label>Patient ID</label>
						<input type="text" name="pat_id" id="pat_id" class="form-control" required />
                        </div>
                        <div class="form-group">
                        <label>Patient Name</label>
						<input type="text" name="name" id="name" class="form-control" required />
                        </div>
                        <div class="form-group">
                        <label>Exam ID</label>
                        <select name="examID" id="examID" class="form-control" required>
                                    <option value="">Select Exam</option>
                                    <?php echo $inventory->seriesDropdownList();?>
                        </select>
						</div>
                        <div class="form-group">
                        <label>Radiographer</label>
						<input type="text" name="pher" id="pher" class="form-control"/>
                        </div>
                        <div class="form-group">
                        <label>Radiologist</label>
						<input type="text" name="gist" id="gist" class="form-control"/>
                        </div>
                        <div class="form-group">
                        <label>Nurse</label>
						<input type="text" name="nurse" id="nurse" class="form-control"/>
                        </div>
    				</div>
    				<div class="modal-footer">
                        <!--
    					<input type="hidden" name="categoryId" id="categoryId"/>-->
    					<input type="hidden" name="btn_action" id="btn_action" value="updateExamInfo"/>
    					<input type="submit" value="Save" />
                        <!--
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
    				</div>
    			</div>
				<br>
    		    </form>
					<button id="addRow">Add new row</button>
    					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
                			<th>Column 1</th>
                			<th>Column 2</th>
                			<th>Column 3</th>
                			<th>Column 4</th>
                			<th>Column 5</th>
            			</tr>
        				</thead>
						<tfoot>
							<tr>
								<th>Column 1</th>
								<th>Column 2</th>
								<th>Column 3</th>
								<th>Column 4</th>
								<th>Column 5</th>
							</tr>
						</tfoot>
    					</table>
			</div>
		</div>	
	</div>	
</div>	
	

<?php include('inc/footer.php');?>