<?php
class Inventory {
	private $host  = 'localhost';
	private $user  = 'root';
	private $password   = '';
	private $database  = 'dsa_inventory_demo';
	private $equipment_details = 'ims_equipment_details';
	private $equipment_used = 'ims_equipment_used';
	private $examSummary = 'ims_exam';
	private $examDetails = 'ims_exam_detail';
	private $examSeries = 'ims_exam_series';
	private $staffList = 'ims_staff';
	private $supplierList = 'ims_supplier';
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

	public function login($email, $password){
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




    
}
?>
