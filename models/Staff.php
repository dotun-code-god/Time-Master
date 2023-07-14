<?php

/**
 * Staff class allows interactions with the database seamless
 */

class Staff {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'time_master';
    public static $con;
    public static $fresh_attendance = true;

    public function __construct()
    {
        self::$con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if(mysqli_connect_error()){
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            return self::$con;
        }
    }

    public function getStaffById(int $id){
        $stmt = self::$con->prepare("SELECT * FROM staffs WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();
        return $staff;
    }

    public static function getAllStaffs(){
        $result = self::$con->query("SELECT * FROM staffs");
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function markStaffAttendance($post) {
        $column = implode(', ', array_keys($post));
        $vals = [...array_values($post)];
        $count = '?';
        $j = count(array_keys($post));
        while($j > 1){
            $count .= ', ?';
            $j = $j - 1;
        }
        $sql = "INSERT INTO staffs_attendance (" . $column . ") VALUES (" . $count . ")";
        $stmt = self::$con->prepare($sql);
        $stmt->bind_param('sii', ...array_values($post));
        $stmt->execute();
        return $this->getAttendanceById(self::$con->insert_id);
    }

    public function updateStaffSalary($data, $id){
        $stmt = self::$con->prepare("UPDATE staffs SET salary = ? WHERE id = ?");
        $stmt->bind_param('ii', $data, $id);
        $stmt->execute();
        return self::$con->affected_rows > 0;
    }

    public static function getStaffAndAttendanceByDate($date){
        $stmt = self::$con->prepare("SELECT * FROM staffs, staffs_attendance WHERE staffs.id = staffs_attendance.staff_id AND `date` = ?");
        $stmt->bind_param('s', $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        if(count($data) < count(self::getAllStaffs())){
            if(count($data) > 0){
                $filteredArr = [];
                $index = [];
                $stat = self::getAllStaffs();
                for($i = 0; $i < count($data); $i++){
                    for($j = 0; $j < count($stat); $j++){
                        if(($data[$i]['staff_id']) == $stat[$j]['id']){
                            $index[] = $j;
                        }
                    }
                }
                for($i = 0; $i < count($stat); $i++){
                    if(!in_array($i, $index)){
                        $filteredArr[] = $stat[$i];
                    }
                }
                $data = array_merge($data, $filteredArr);
            }else $data = self::getAllStaffs();

            if($date !== date("Y-m-d") && $date < date("Y-m-d")){
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['expired'] = true;
                }
                self::$fresh_attendance = false;
            }
        }
        return $data;
    }

    public function getAttendanceById($id){
        $stmt = self::$con->prepare("SELECT * FROM staffs_attendance WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $attendance = $result->fetch_assoc();
        return $attendance;
    }
}