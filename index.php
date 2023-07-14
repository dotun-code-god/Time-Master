<?php
require_once './staff_controller.php';

new Staff();

if(isset($_GET['date'])){
    $staffs = Staff::getStaffAndAttendanceByDate($_GET['date']);
} else {
    $date = date('Y-m-d');
    $staffs = Staff::getStaffAndAttendanceByDate($date);
    $_GET['date'] = $date;
}

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
        <div class="md:block hidden">
            <h3 id="selected_date" class="text-lg bg-yip_black text-white px-4 py-3" style="text-shadow:-1px 0px 4px #abaaaa;"></h3>
        </div>
        <div class="md:block hidden">
            <input type="date" name="date" form="attendance_form" class="rounded-md" id="select_date" value="<?=$_GET['date']?>">
        </div>
    </div>
    <div class="mt-12 md:hidden flex justify-between items-center gap-2">
        <div>
            <h3 id="selected_date_mobile" class="sm:text-lg bg-yip_black text-white px-4 py-3" style="text-shadow:-1px 0px 4px #abaaaa;"></h3>
        </div>
        <div>
            <input type="date" name="date" form="attendance_form" class="rounded-md" id="select_date" value="<?=$_GET['date']?>">
        </div>
    </div>

    <form action="manage_attendance.php" method="POST" id="attendance_form">
        <div class="sm:mt-16 mt-8">
            <div class="sm:flex items-center justify-between">
                <div class="relative">
                    <h1 class="text-xl font-semibold uppercase">Employees</h1>
                    <span class="absolute bg-yip_black w-[2rem] h-[0.2rem]"></span>
                </div>

                <?php if(isset($_SESSION['success'])) { ?>
                    <p class="italic"><?=$_SESSION['success']?></p>
                <?php } ?>
                <?php if(isset($_SESSION['wrong_access'])) { ?>
                    <p class="italic"><?=$_SESSION['wrong_access']?></p>
                <?php } ?>
    
                <div class="sm:mt-0 mt-8 flex items-center justify-between gap-4">
                    <button type="button" class="yip_button shadow-[-1px_1px_5px_#ce2222] <?= Staff::$fresh_attendance ? 'show' : 'hidden' ?>" style="background:linear-gradient(45deg, #f53535, #592020)" onclick="markAll(false)">mark all absent</button>
                    <button type="button" class="yip_button shadow-[-1px_1px_5px_#1d7fc1] <?= Staff::$fresh_attendance ? 'show' : 'hidden' ?>" style="background:linear-gradient(45deg, #2289ce, #084771)" onclick="markAll(true)">mark all present</button>
                </div>
            </div>
    
            <div class="sm:my-8 my-4">
                <table class="table yip_table_layout max-w-full w-full" id="employees_table">
                    <tr class="yip_table_layout">
                        <th class="yip_table_layout p-4">Name</th>
                        <th class="yip_table_layout p-4">Current Salary (10,000)</th>
                        <th class="yip_table_layout p-4">Attendance</th>
                    </tr>
                    <?php if(count($staffs) > 0){
                        foreach($staffs as $staff){ ?>
                            <tr class="yip_table_layout">
                                <td class="p-3 flex items-center gap-3 xs:text-sm">
                                    <span __name="<?=$staff['name']?>" class="yip_staff_pseudo_img pseudo_image sm:block hidden"></span>
                                    <?=$staff['name']?> 
                                </td>
                                <td class="p-3 yip_table_layout text-center xs:text-sm"><?=$staff['salary']?></td>
                                <td class="p-3 yip_table_layout text-right xs:text-sm">
                                    <label for="present-<?=$staff['id']?>" id="label_present-<?=$staff['id']?>" class="mr-6">
                                        <input type="checkbox" class="yip_attendance" name="present-<?=$staff['id']?>" id="present-<?=$staff['id']?>" 
                                            onclick="selectAndDeselectAttendance('present-<?=$staff['id']?>')" value="1" <?php if(isset($staff['attendance_status']) || isset($staff['expired'])){?> disabled <?php } ?>
                                            <?php if(isset($staff['attendance_status']) && $staff['attendance_status']){?> checked <?php } ?> 
                                        />
                                        Present
                                    </label>
                                    <label for="absent-<?=$staff['id']?>" id="label_absent-<?=$staff['id']?>">
                                        <input type="checkbox" class="yip_attendance" name="absent-<?=$staff['id']?>" id="absent-<?=$staff['id']?>" 
                                            onclick="selectAndDeselectAttendance('absent-<?=$staff['id']?>')" value="0" <?php if(isset($staff['attendance_status']) || isset($staff['expired'])){?> disabled <?php } ?>
                                            <?php if(isset($staff['attendance_status']) && !$staff['attendance_status']){?> checked <?php } ?> 
                                            />
                                        Absent
                                    </label>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>
    
            <div class="flex justify-center">
                <button name="submit" class="yip_button shadow-[-1px_1px_5px_#87ad22] <?= Staff::$fresh_attendance ? 'show' : 'hidden' ?>" style="background:linear-gradient(45deg, #b5d75c, #44590f)">done</button>
            </div>
        </div>
    </form>

    <script src="public/js/app.js"></script>
</body>
</html>