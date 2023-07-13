<?php

require_once 'models/Staff.php';

/**
 * Staff Controller class controls each staff attendance records as well as payroll.
 */

class StaffController {
    public $staff;
    
    public function __construct()
    {
        $this->staff = new Staff();
    }

    public function getDetails($id){
        return $this->staff->getStaffById($id);
    }

    public function updateInfo($id){

    }

    public function markAttendance($id){

    }
}