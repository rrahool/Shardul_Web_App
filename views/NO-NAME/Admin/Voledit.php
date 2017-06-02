<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;
if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

$objVolEdit= new \App\WareHouse\VolunteerStore();
$objVolEdit-> setdata($_REQUEST);
$VolEdit= $objVolEdit->view();

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
    <form action="VolUpdate.php" class="editForm" method="post">
        <h2>VOLUNTEER EDIT</h2>
        <?php
        if(!empty($msg)) {
            echo "<div id='message'> $msg </div>";
        }
        ?>
        <label>User Name</label><br>
        <input type="text" placeholder="User Name" name="userName" value="<?php echo $VolEdit->user_name; ?>"><br>
        <label>Board Exam</label><br>
        <select name="highestEducation">
            <option value="">Select Secondary or Higher secondary Exam</option>
            <option value="ssc" <?php if ($VolEdit->highest_education=="ssc") echo "selected";?>>S.S.C</option>
            <option value="hsc" <?php if ($VolEdit->highest_education=="hsc") echo "selected";?>>H.S.C</option>
        </select><br>
        <label for="passingYear">Passing year</label><span class="error" > *</span>
        <input type="number" min="0" max="9999" name="passingYear" placeholder="Passing Year." id="passingYear" value="<?php echo $VolEdit->passing_year; ?>">
        <label for="roll">Roll No</label><span class="error" > *</span>
        <input type="text" name="roll"  placeholder="Roll No." id="roll" value="<?php echo $VolEdit->roll; ?>">

        <label>Phone Number</label><br>
        <input type="text" placeholder="Phone Number" name="phone" value="<?php echo $VolEdit->phone ?>"><br>
        <input type="hidden" name="id" value="<?php echo $VolEdit->id ?>">
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