<?php
if(!isset($_SESSION) )session_start();
require_once ('../../../../vendor/autoload.php');
use App\Message\Message;
use App\Utility\Utility;

use App\WareHouse\UserStore;
use App\WareHouse\Authentication;
use App\WareHouse\VolunteerStore;

$auth= new Authentication();
$auth->setData($_SESSION);
$status=$auth->logged_in();
if(!$status) {
    Utility::redirect('index.html');
    die();
}
$obj= new UserStore();
$obj->setData($_SESSION);
$singleUser = $obj->view();
$userID=$singleUser->id;

$obj= new VolunteerStore();
$obj->setUserId($userID);
$volunteerUser = $obj->VolunteerProfileInfo();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শার্দূল</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../../../resource/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link href="../../../../resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../resource/css/style.css" rel="stylesheet">
    <link href="../../../../resource/css/countdown.css" rel="stylesheet">
    <link href="../../../../resource/css/jquery.countdown.css" rel="stylesheet">
    <link href="../../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../../resource/css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>
<div class="col-xs-12 col-sm-12- col-md-2 col-lg-2"></div>

<div class="col-xs-12 col-sm-12- col-md-8 col-lg-8">
    <form action="Volunteer_profile-update.php" method="post" class="editForm">

        <h2>Editing <?php echo $singleUser->user_name?></h2>

        <? if(!isset($_SESSION))session_start();
            $msg = Message::getMessage();
        ?>
        <div id="">
            <?php
            if(!empty($msg))
            echo $msg;
            ?>
        </div>
        <label>Email</label>
        <input type="email" name="Email" value="<?php echo $singleUser->email?>" placeholder="email" id="frmm">
        <label>Password</label>
        <input type="password" name="Password" value="<?php echo $singleUser->password  ?>" placeholder="password" id="frmmm">

        <label>Phone Number</label>
        <input type="tel" name="phone" value="<?php echo $singleUser->phone?>" placeholder="phonenumber" required >

        <label>Board Exam</label>
        <input type="text" name="highestEducation" value="<?php echo $volunteerUser->highest_education  ?>" placeholder="Highest Education" id="frm">
        <label>Passing Year</label>
        <input type="text" name="passingYear" value="<?php echo $volunteerUser->passing_year  ?>" placeholder="Passing Year" id="frm"">
        <label>Roll No</label>
        <input type="text" name="roll" value="<?php echo $volunteerUser->roll ?>"  placeholder="Roll" id="frm">
        
        <input type="hidden" name ="userID" value="<?php echo $userID;?>">
        <input type="submit" value="UPDATE">

    </form>
</div>

<div class="col-xs-12 col-sm-12- col-md-2 col-lg-2"></div>
</body>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script type="text/javascript">

    jQuery(function($) {
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
    })
</script>
</html>
