<?php
class Inventory {
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = '';
    private $database  = 'dsa_inventory_demo';   
	private $EquipmentDetails = 'ims_equipment_details';	
    private $EquipmentUsed = 'ims_equipment_used';
	private $ExamSummary = 'ims_exam';
	private $ExamDetails = 'ims_exam_detail';
	private $ExamSeries = 'ims_exam_series';
	private $StaffList = 'ims_staff';
	private $SupplierList = 'ims_supplier';
	private $orderTable = 'ims_order';
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

	public function login($email, $password){
		$password = md5($password);
		$sqlQuery = "
			SELECT userid, email, password, name, type, status
			FROM ".$this->userTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}

	public function checkLogin(){
		if(empty($_SESSION['userid'])) {
			header("Location:login.php");
		}
	}




    
}
?>