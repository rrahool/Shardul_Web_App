<?php
session_start();
require_once "../../../vendor/autoload.php";
$objVolview= new\App\WareHouse\VolunteerStore();
$objVolview->setdata($_GET);
$Volview = $objVolview->view();

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
            <li><label>User Name :&nbsp;</label><?php echo $Volview->user_name ?></li>
            <li><label>Name :&nbsp;</label><?php echo "$Volview->firstname $Volview->lastname" ?></li>
            <li><label>Phone :&nbsp;</label><?php echo "$Volview->phone" ?></li>
            <li><label>Email :&nbsp;</label><?php echo  "$Volview->email" ?></li>
            <li><label>Address :&nbsp;</label><?php echo "$Volview->address" ?></li>
        </ul>
        <h1 style="color: #f0ad4e">Volunteer</h1>
        <table cellpadding="0" cellspacing="0">
            <tr class="titleHead">
                <th>ID</th>
                <th>Board Exam</th>
                <th>Roll</th>
                <th>Passing Year</th>
                <th>Edit</th>
            </tr>
            <tr>
                <td><?php echo $Volview->id ?></td>
                <td><?php echo $Volview->highest_education ?></td>
                <td><?php echo $Volview->roll ?></td>
                <td><?php echo $Volview->passing_year?></td>
                <td class="act"><a href='Voledit.php?id=<?php echo $Volview->id ?>' class='btn btn-primary btn-block'><span class="glyphicon glyphicon-pencil"></span></a></td>
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