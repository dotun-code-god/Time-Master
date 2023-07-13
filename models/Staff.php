<?php

/**
 * Staff class allows interactions with the database seamless
 */

class Staff {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'time_master';
    public $con;

    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if(mysqli_connect_error()){
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            return $this->con;
        }
    }

    public function getStaffById(int $id){
        $stmt = $this->con->prepare("SELECT * FROM staff WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();
        return $staff;
    }

    public function updateStaffById(int $id){
        // $sql = "UPDATE staff SET "
    }

    public function markStaffAttendance($id) {

    }
}