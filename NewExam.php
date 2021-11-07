<?php 
session_start();
include('inc/header.php');
include 'function.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/NewExam.js"></script>


<?php include('inc/container.php');?>


<div class="container">		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div>
							<h3 class="panel-title">Add New Exam</h3>
						</div>
					</div>					   
					<div class="clear:both"></div>
				</div>
                <form method="post" id="newExamForm">
    			<div class="modal-content">
    				<div class="modal-body">
                        <div class="form-group">
    					<label>Accession Number</label>
						<input type="text" name="acc_id" id="acc_id" class="form-control" required />
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
    				</div>
    				<div class="modal-footer">
                        <!--
    					<input type="hidden" name="categoryId" id="categoryId"/>-->
    					<input type="hidden" name="btn_action" id="btn_action" value="addNewExam"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                        <!--
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
    				</div>
    			</div>
    		    </form>
			</div>
		</div>	
	</div>	
</div>	
	

<?php include('inc/footer.php');?>