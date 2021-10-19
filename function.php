<?php
class Inventory {
	private $host  = 'localhost';
	private $user  = 'root';
	private $password   = '';
	private $database  = 'dsa_inventory_demo';
	private $equipment_details = 'ims_equipment_details';
	private $equipment = 'ims_equipment';
	private $examSummary = 'ims_exam';
	private $examDetails = 'ims_exam_detail';
	private $examSeries = 'ims_exam_series';
	private $staffList = 'ims_staff';
	private $supplierTable = 'ims_supplier';
	private $userTable = 'ims_user';
	private $dbConnect = false;

    //sql connect
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }

	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}

	public function login($userid, $password){
		$password = md5($password);
		$sqlQuery = "
			SELECT userid, username, password, type, status
			FROM ".$this->userTable." 
			WHERE userid='".$userid."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}

	public function checkLogin(){
		if(empty($_SESSION['userid'])) {
			header("Location:login.php");
		}
	}


	public function checkAdmin(){
		$sqlQuery = "
			SELECT userid, username, password, type, status
			FROM ".$this->userTable." 
			WHERE userid='".$_SESSION['userid']."'";
		$userInfo = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_row($userInfo);
		if($row[3]=="admin") {
			$admin = true;
		    return $admin;
	    } else {
		    header("Location:index.php");
	    }
	}

	public function getSupplierList(){		
		$sqlQuery = "SELECT * FROM ".$this->supplierTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (supplier_name LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (salesperson LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$ordIndex = $_POST["order"]['0']['column']+1;
			$sqlQuery .= 'ORDER BY '.$ordIndex.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY supplier_id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$supplierData = array();	
		while( $supplier = mysqli_fetch_assoc($result) ) {	
			$status = '';
			if($supplier['status'] == 'active') {
				$status = '<span class="label label-success">Active</span>';
			} else {
				$status = '<span class="label label-danger">Inactive</span>';
			}
			$supplierRows = array();
			$supplierRows[] = $supplier['supplier_id'];		
			$supplierRows[] = $supplier['supplier_name'];	
			$supplierRows[] = $supplier['salesperson'];			
			$supplierRows[] = $supplier['mobile'];	
			$supplierRows[] = $status;
			$supplierData[] = $supplierRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$supplierData
		);
		echo json_encode($output);
	}

	
	public function getInventoryList(){		
		$sqlQuery = "SELECT * FROM ".$this->equipment_details." as eqd
			INNER JOIN ".$this->equipment." as eq ON eq.EquipmentModel = eqd.EquipmentModel 
			INNER JOIN ".$this->supplierTable." as s ON s.supplier_id = eqd.supplier_id ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (EquipmentName LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (EquipmentID LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$ordIndex = $_POST["order"]['0']['column']+1;
			$sqlQuery .= 'ORDER BY '.$ordIndex.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY EquipmentName DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$inventoryData = array();	
		while( $inventory = mysqli_fetch_assoc($result) ) {
			$inventoryRows = array();
			$inventoryRows[] = $inventory['EquipmentID'];		
			$inventoryRows[] = $inventory['EquipmentName'];	
			$inventoryRows[] = $inventory['supplier_name'];			
			$inventoryRows[] = $inventory['ExpiryDate'];	
			$inventoryRows[] = $inventory['InventoryOnHand'];
			$inventoryData[] = $inventoryRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$inventoryData
		);
		echo json_encode($output);
	}

	public function getExpireList(){		
		$sqlQuery = "SELECT * FROM ".$this->equipment_details." as eqd
			INNER JOIN ".$this->equipment." as eq ON eq.EquipmentModel = eqd.EquipmentModel ";
		
		
		$sqlQuery .= 'WHERE ExpiryDate < DATE_ADD(NOW(), INTERVAL 3000 DAY) ';
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'AND (EquipmentName LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (EquipmentID LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		/*
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (EquipmentName LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (EquipmentID LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		*/

		if(!empty($_POST["order"])){
			$ordIndex = $_POST["order"]['0']['column']+1;
			$sqlQuery .= 'ORDER BY '.$ordIndex.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY EquipmentName DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$inventoryData = array();	
		while( $inventory = mysqli_fetch_assoc($result) ) {
			$inventoryRows = array();
			$inventoryRows[] = $inventory['EquipmentName'];		
			$inventoryRows[] = $inventory['LotNum'];
			$inventoryRows[] = $inventory['ExpiryDate'];	
			$inventoryRows[] = $inventory['InventoryOnHand'];
			$inventoryData[] = $inventoryRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$inventoryData
		);
		echo json_encode($output);
	}
	
	public function getExamList(){		
		$sqlQuery = "SELECT * FROM ".$this->examSummary." as esum
			INNER JOIN ".$this->examSeries." as eser ON esum.ExamID = eser.ExamID ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (PatientID LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (PatientName LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (AccessionNumber LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$ordIndex = $_POST["order"]['0']['column']+1;
			$sqlQuery .= 'ORDER BY '.$ordIndex.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY ExamDate DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$inventoryData = array();	
		while( $inventory = mysqli_fetch_assoc($result) ) {
			$inventoryRows = array();
			$inventoryRows[] = $inventory['ExamDate'];		
			$inventoryRows[] = $inventory['PatientID'];	
			$inventoryRows[] = $inventory['AccessionNumber'];			
			$inventoryRows[] = $inventory['PatientName'];	
			$inventoryRows[] = $inventory['ExamName'];
			$inventoryData[] = $inventoryRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$inventoryData
		);
		echo json_encode($output);
	}

	public function getSpecList(){		
		$sqlQuery = "SELECT * FROM ".$this->equipment_details." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'WHERE (EquipmentModel LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (EquipmentName LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= 'OR (EquipmentType LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$ordIndex = $_POST["order"]['0']['column']+1;
			$sqlQuery .= 'ORDER BY '.$ordIndex.' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY EquipmentModel DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$inventoryData = array();	
		while( $inventory = mysqli_fetch_assoc($result) ) {
			$inventoryRows = array();
			$inventoryRows[] = $inventory['EquipmentModel'];		
			$inventoryRows[] = $inventory['EquipmentName'];	
			$inventoryRows[] = $inventory['EquipmentType'];
			$inventoryData[] = $inventoryRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$inventoryData
		);
		echo json_encode($output);
	}

	public function seriesDropdownList(){	
		$sqlQuery = "SELECT * FROM ".$this->examSeries." ORDER BY ExamID ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$dropdownHTML = '';
		while( $series = mysqli_fetch_assoc($result) ) {	
			$dropdownHTML .= '<option value="'.$series["ExamID"].'">'.$series["ExamName"].'</option>';
		}
		return $dropdownHTML;
	}

	public function newExamForm() {
		$sqlQuery = "SELECT * FROM ".$this->examSummary."
			WHERE AccessionNumber = '".$_POST['acc_id']."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!is_null($result)){
			echo '<script>alert("Study already exists!");
			location="NewExam.php";
			</script>';
		} else {
			$sqlInsert = "
			INSERT INTO ".$this->examSummary."(PatientID, AccessionNumber, PatientName, ExamID, ExamDate) 
			VALUES ('".$_POST['pat_id']."', '".$_POST['acc_id']."', '".$_POST['name']."''".$_POST['examID']."')";		
			mysqli_query($this->dbConnect, $sqlInsert);
			header('Location: EditExam.php?acc_id='.$_POST['acc_id']);
		}
	}		

	public function getExamInfo(){		
		$sqlQuery = "SELECT * FROM ".$this->examSummary." as esum
			LEFT JOIN ".$this->examDetails." as eDe ON esum.AccessionNumber = eDe.AccessionNumber 
			INNER JOIN ".$this->examSeries." as eSer ON esum.ExamID = eSer.ExamID 
			WHERE esum.AccessionNumber = '".$_POST['acc_num']."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
}
?>
