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
            <h3 id="selected_date" class="text-lg bg-yip_black text-white px-4 py-3" style="text-shadow:-1px 0px 4px #abaaaa;"></h3>
        </div>
        <div>
            <input type="date" class="rounded-md" id="select_date">
        </div>
    </div>

    <div class="mt-16">
        <div class="flex items-center justify-between">
            <div class="relative">
                <h1 class="text-xl font-semibold uppercase">Employees</h1>
                <span class="absolute bg-yip_black w-[2rem] h-[0.2rem]"></span>
            </div>

            <div class="flex items-center justify-between gap-4">
                <button class="yip_button shadow-[-1px_1px_5px_#ce2222]" style="background:linear-gradient(45deg, #f53535, #592020)" onclick="markAll(false)">mark all absent</button>
                <button class="yip_button shadow-[-1px_1px_5px_#1d7fc1]" style="background:linear-gradient(45deg, #2289ce, #084771)" onclick="markAll(true)">mark all present</button>
            </div>
        </div>

        <div class="my-8">
            <table class="table yip_table_layout max-w-full w-full" id="employees_table">
                <tr class="yip_table_layout">
                    <th class="yip_table_layout p-4">Name</th>
                    <th class="yip_table_layout p-4">Current Salary (10,000)</th>
                    <th class="yip_table_layout p-4">Attendance</th>
                </tr>
                <tr class="yip_table_layout">
                    <td class="p-3 flex items-center gap-3">
                        <span id="pseudo_image" class="yip_staff_pseudo_img bg-blue-200">SJ</span>
                        Shamma Joy
                    </td>
                    <td class="p-3 yip_table_layout text-center">10,000</td>
                    <td class="p-3 yip_table_layout text-right">
                        <label for="present1" id="label_present1" class="mr-6">
                            <input type="checkbox" class="yip_attendance" name="present1" id="present1" onclick="selectAndDeselectAttendance('present1')">
                            Present
                        </label>
                        <label for="absent1" id="label_absent1">
                            <input type="checkbox" class="yip_attendance" name="absent1" id="absent1" onclick="selectAndDeselectAttendance('absent1')">
                            Absent
                        </label>
                    </td>
                </tr>
                <tr class="yip_table_layout">
                    <td class="p-3 flex items-center gap-3">
                        <span id="pseudo_image" class="yip_staff_pseudo_img bg-red-200">OD</span>
                        Olaolu David
                    </td>
                    <td class="p-3 yip_table_layout text-center">9,950</td>
                    <td class="p-3 yip_table_layout text-right">
                        <label for="present2" id="label_present2" class="mr-6">
                            <input type="checkbox" class="yip_attendance" name="present2" id="present2" onclick="selectAndDeselectAttendance('present2')">
                            Present
                        </label>
                        <label for="absent2" id="label_absent2">
                            <input type="checkbox" class="yip_attendance" name="absent2" id="absent2" onclick="selectAndDeselectAttendance('absent2')">
                            Absent
                        </label>
                    </td>
                </tr>
                <tr class="yip_table_layout">
                    <td class="p-3 flex items-center gap-3">
                        <span id="pseudo_image" class="yip_staff_pseudo_img bg-green-200">AE</span>
                        Adeleke Eniola
                    </td>
                    <td class="p-3 yip_table_layout text-center">9000</td>
                    <td class="p-3 yip_table_layout text-right">
                        <label for="present3" id="" class="mr-6">
                            <input type="checkbox" class="yip_attendance" name="present3" id="present3">
                            Present
                        </label>
                        <label for="absent3" id="">
                            <input type="checkbox" class="yip_attendance" name="absent3" id="absent3">
                            Absent
                        </label>
                    </td>                </tr>
            </table>
        </div>

        <div class="flex justify-center">
            <button class="yip_button shadow-[-1px_1px_5px_#87ad22]" style="background:linear-gradient(45deg, #b5d75c, #44590f)">done</button>
        </div>
    </div>

    <script src="public/js/app.js"></script>
</body>
</html>