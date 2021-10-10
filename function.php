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
    
}
?>
