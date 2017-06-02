
<?php
if(!isset($_SESSION) )session_start();
require_once ('../../../../vendor/autoload.php');
use APP\Message\Message;

use App\Utility\Utility;

use App\WareHouse\UserStore;
use App\WareHouse\Authentication;

$obj= new UserStore();
$obj->setData($_SESSION);
$singleUser = $obj->view();

$auth= new Authentication();
$auth->setData($_SESSION);
$status=$auth->logged_in();

if(!$status) {
    Utility::redirect('index.html');
}

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
<form action="Blood_Donor_profile-update.php" method="post" class="editForm">

    <h2>Editing <?php echo $singleUser->user_name ?></h2>
    <label for="">Firstname</label>
    <input type="text" name="FirstName" value="<?php echo $singleUser->firstname  ?>" placeholder="firstname" id="frm">

    <label for="">LastName</label>
    <input type ="text" name="LastName" value="<?php echo $singleUser->lastname  ?>" placeholder="lastname" id="frm">
    <label for="">Email</label>
    <input type="email" name="Email" value="<?php echo $singleUser->email?>" placeholder="email" id="frmm">

    <label for="">Password</label>
    <input type="password" name="Password" value="<?php echo $singleUser->password  ?>" placeholder="password" id="frmmm">

    <label for="">Birth Date</label>
    <input type="date" name="BirthDate" value="<?php echo $singleUser->dob?>" placeholder="Date Of Birthday" id="frm">

    <label for="">Phone Number</label>
    <input type="tel" name="PhoneNumber" value="<?php echo $singleUser->phone?>" placeholder="phonenumber" required >
    <label for="">Address</label>
    <input type="text" name="ADDRSS" value="<?php echo $singleUser->address?>" placeholder="address" id="frm" >

    <input type="hidden" name="userID" value="<?php echo $singleUser->id ?>">
    
    <input type="submit" name="Next" value="UPDATE">

</form>
</div>

<div class="col-xs-12 col-sm-12- col-md-2 col-lg-2"></div>
</body>
</html>
