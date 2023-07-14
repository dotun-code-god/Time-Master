<?php

require_once './staff_controller.php';
$staff = new StaffController();

if(isset($_POST['submit'])){
    $keys = [...array_keys($_POST)];
    $vals = [...array_values($_POST)];
    $post = [];
    $post['date'] = $vals[0];
    for($i = 1; $i < count($keys)-1; $i++){
        $post['staff_id'] = explode('-', $keys[$i])[1];
        $post['attendance_status'] = $vals[$i];
        $staff->markAttendance($post);
    }
    $_SESSION['success'] = "Attendance registered successfully, have a nice day at work";
    header("Location: index.php?date=".$post['date']);
} else {
    $_SESSION['wrong_access'] = "Sorry, you are not authorized access to this route";
    header("Location: index.php");
}
