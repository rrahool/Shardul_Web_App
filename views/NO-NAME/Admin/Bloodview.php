<?php
session_start();
require_once "../../../vendor/autoload.php";
$objBloodView= new\App\WareHouse\BloodDonorStore();
$objBloodView->setdata($_GET);
$BloodView = $objBloodView-> view();

if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
include_once "dashboard.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<div class="main-content container-fluid">
    <div class="table-hold">
        <img src="../../../resource/img/admin/pro-pic/admin.png" alt="" class="animated fadeIn" style="width: 200px">
        <ul class="view_info animated fadeInRight">
            <li><label>User Name :&nbsp;</label><?php echo $BloodView->user_name ?></li>
            <li><label>Name :&nbsp;</label><?php echo "$BloodView->firstname $BloodView->lastname" ?></li>
            <li><label>Phone :&nbsp;</label><?php echo "$BloodView->phone" ?></li>
            <li><label>Email :&nbsp;</label><?php echo "$BloodView->email" ?></li>
            <li><label>Address :&nbsp;</label><?php echo "$BloodView->address" ?></li>
        </ul>
        <table cellpadding="0" cellspacing="0">
            <h1 style="color: tomato">Donor</h1>
            <tr class="titleHead">
                <th>ID</th>
                <th>Blood Group</th>
                <th>Status</th>
                <th>Preferable Time</th>
                <th>Edit</th>
            </tr>
            <tr>
                <td><?php echo $BloodView->id ?></td>
                <td><?php echo $BloodView->blood_group ?></td>
                <td><?php
                    $nextdate = date("Y-m-d", strtotime("$BloodView->last_donate_date +4 month"));
                    $today = date("Y-m-d");

                    if ($nextdate > $today) {

                        $status = "not available";
                    } else {

                        $status = "available";
                    }

                    echo $status ?></td>
                <td><?php echo $BloodView->prfrbl_time ?></td>
                <td class="act"><a href='Bloodedit.php?id=<?php echo $BloodView->id ?>' class='btn btn-primary btn-block'><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
        </table>
    </div>
</div>


<?php
}else{
    include_once "AdminLoginForm.php";
}
?>
</body>
<script>
    jQuery(function($) {
        $('#message').fadeOut (700);
        $('#message').fadeIn (700);
        $('#message').fadeOut (700);
        $('#message').fadeIn (700);
        $('#message').fadeOut (700);
    })
</script>
</html>