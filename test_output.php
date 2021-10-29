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

    public function getData($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error($this->dbConnect));
        }
        $data= array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[]=$row;            
        }
        return $data;
    }

}

$inventory = new Inventory();
$userTable_hash = 'ims_user_hash';
$userid = 'admin';

$sqlQuery = "
SELECT userid, username, password, type, status
FROM ".$userTable_hash." 
WHERE userid='".$userid."'";
$result = $inventory->getData($sqlQuery);


echo $result[0]["password"];
echo password_verify($result[0]["password"], );

?>