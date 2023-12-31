<?php

require_once 'models/Staff.php';

class StaffController {
    public $staff;
    private $pay_day = 100;

    public function __construct()
    {
        $this->staff = new Staff();
    }

    public function markAttendance($post){
        $id = $this->staff->markStaffAttendance($post);
        if($post['attendance_status'] === 0){
            // reduce payment if staff be found absent
            $this->reduceSalaryDueToAbsence($id);
        }
    }

    public function reduceSalaryDueToAbsence($id){
        if($staff = $this->staff->getStaffById($id)){
            $cur_salary = $staff['salary'];
            $new_salary = $cur_salary - $this->pay_day;
            return $this->staff->updateStaffSalary($new_salary, $id);
        }
    }

}

echo 'test';