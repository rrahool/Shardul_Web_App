<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;
if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

$objBloodEdit= new \App\WareHouse\BloodDonorStore();
$objBloodEdit-> setdata($_REQUEST);
$BloodEdit= $objBloodEdit->view();

if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
include_once "dashboard.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blood Donor Edit</title>
</head>
<body>
<div class="main-content container-fluid">
    <form action="BloodUpdate.php" class="editForm" method="post">
        <h2>DONOR EDIT</h2>
        <?php
        if(!empty($msg)) {
            echo "<div id='message'> $msg </div>";
        }
        ?>
        <label>User Name</label><br>
        <input type="text" placeholder="User Name" name="userName" value="<?php echo $BloodEdit->user_name; ?>"><br>
        <label>Blood Group</label><br>
        <select name="Bloodgroup">
            <option value="O-"<?php if ($BloodEdit->blood_group=="O-") echo "selected";?>>O-</option>
            <option value="A-"<?php if ($BloodEdit->blood_group=="A-") echo "selected";?>>A-</option>
            <option value="B-"<?php if ($BloodEdit->blood_group=="B-") echo "selected";?>>B-</option>
            <option value="AB-"<?php if ($BloodEdit->blood_group=="AB-") echo "selected";?>>AB-</option>
            <option value="O+"<?php if ($BloodEdit->blood_group=="O+") echo "selected";?>>0+</option>
            <option value="A+"<?php if ($BloodEdit->blood_group=="A+") echo "selected";?>>A+</option>
            <option value="B+"<?php if ($BloodEdit->blood_group=="B+") echo "selected";?>>B+</option>
            <option value="AB+"<?php if ($BloodEdit->blood_group=="AB+") echo "selected";?>>AB+</option>
        </select><br>
        <label>Preferable Time</label><br>
        <select name="PreferableTime" id="Timezone">
            <option  value="TimeZone1"<?php if ($BloodEdit->prfrbl_time=="TimeZone1") echo "selected";?>>Morning To Noon</option>
            <option value="TimeZone2"<?php if ($BloodEdit->prfrbl_time=="TimeZone2") echo "selected";?>>Noon To Afternoon</option>
            <option value="TimeZone3"<?php if ($BloodEdit->prfrbl_time=="TimeZone3") echo "selected";?>>Afternoon To Evening</option>
            <option value="TimeZone4"<?php if ($BloodEdit->prfrbl_time=="TimeZone4") echo "selected";?>>Evening To Night</option>
            <option value="Anytime"<?php if ($BloodEdit->prfrbl_time=="Anytime") echo "selected";?>>Anytime</option>
        </select><br>
        <label>Phone Number</label><br>
        <input type="text" placeholder="Phone Number" name="phone" value="<?php echo $BloodEdit->phone ?>"><br>
        <input type="hidden" name="id" value="<?php echo $BloodEdit->id ?>">
        <input type="submit" value="Update">
    </form>
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