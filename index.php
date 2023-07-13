<?php
require_once 'controllers/staffController.php';

$staff = new StaffController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="dist/output.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- <script src="public/js/jquery.min.js"></script> -->
    <title>YIP Online | Staff Attendance & Payroll Management</title>
</head>
<body class="sm:mx-[5%] mx-[3%] my-[2%] font-Poppins">
    <div class="flex items-center justify-between">
        <div class="flex gap-4 items-center">
            <div class="relative">
                <img src="public/img/yip-online.png" class="w-32" alt="time master logo">
                <span class="absolute bg-[#e7e7e7] w-[0.15rem] h-[calc(100%+1rem)] -right-2 top-0"></span>
            </div>
            <h1 class="text-xl font-bold mt-2 leading-6" style="text-shadow:-1px 1px 3px #c7c7c7;">Staff Attendance & <br> Payroll Management</h1>
        </div>
        <div>
            <h3 id="selected_date" class="text-lg bg-[#212529] text-white px-4 py-3" style="text-shadow:-1px 0px 4px #abaaaa;"></h3>
        </div>
        <div>
            <input type="date" class="rounded-md" id="select_date">
        </div>
    </div>

    <div class="mt-16">
        <h1 class="text-lg font-semibold uppercase">Employees</h1>
    </div>

    <script src="public/js/app.js"></script>
</body>
</html>