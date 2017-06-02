<?php
if(!isset($_SESSION) )session_start();
require_once ('../../../../vendor/autoload.php');
use APP\Message\Message;

use App\Utility\Utility;

use App\WareHouse\UserStore;
use App\WareHouse\Authentication;
use App\WareHouse\BloodDonorStore;
use App\WareHouse\VolunteerStore;

$auth= new Authentication();
$auth->setData($_SESSION);
$status=$auth->logged_in();

if(!$status) {
    Utility::redirect('../../../index.html');
    return;
}
$obj= new UserStore();
$obj->setData($_SESSION);
$singleUser = $obj->view();

$BlooduserID = $singleUser->id;
$role = $singleUser->role;

if($role="BloodDonor"){
    $obj= new BloodDonorStore();
    $obj->setUserId($BlooduserID);
    $bloodDonorUser = $obj->BloodDonorProfileInfo();
}
$today = date("Y-m-d");
$DATEuPDATE= date("Y-m-d", strtotime("$bloodDonorUser->last_donate_date +3 month"))
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শার্দূল</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../../../resource/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../../../../resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../resource/css/style.css" rel="stylesheet">
    <link href="../../../../resource/css/countdown.css" rel="stylesheet">
    <link href="../../../../resource/css/jquery.countdown.css" rel="stylesheet">
    <link href="../../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../../resource/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>
<div class="container-fluid" id="userHold">


    <div class="nav-holder">
        <h3 style="display: inline-block; position: absolute; top: 10px; left:200px ; color: lightseagreen"><i class="ti-user"></i>&nbsp;<?php echo $singleUser->user_name?></h3>
        <div class="userlink pull-right">
            <div class="dropdown">
                <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" style="margin-top: 20px; margin-right: 20px" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                    <i class="ti-paint-roller"> </i>
                    Actions
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu animated swing" aria-labelledby="dLabel">
                    <li><a href="../Proffile/Blood_Donor_profile-edit.php" id="logout">Edit Profile</a></li>
                    <li><a href="../Authentication/Logout.php" id="logout"> logout</a></li>
                </ul>
            </div>
        </div>
        <div class="user-image-hold">
            <form role="form" method="post" action="ppstore.php" enctype="multipart/form-data">
                <input type="file" name="blood_donor_pp" multiple="multiple">
                <input type="hidden" name ="BlooduserID" value="<?php echo $BlooduserID;?>">
                <button type="submit" name="upload" class="upload"><i class="ti-camera"></i></button>
            </form>
            <img src="icons/<?php echo $bloodDonorUser->profile_picture;?> ">
        </div>
    </div>







    <div class="container-fluid CountMonths">
        <?php  if($DATEuPDATE == date('Y-m-d')){; ?>
        <form action="UPDATE-Last-Donate-Date.php" method="post">
            <input type="hidden" name="update-donate-date" value="<?php echo $today;?>">
            <input type="hidden" name ="BlooduserID" value="<?php echo $BlooduserID;?>">
            <button type="submit">I HAVE DONATED TODAY</button>
        </form>
        <?php } ?>
        <div id="countdown"></div>
        <div id="note"></div>
    </div>
    <div class="AboutUser">
        <h2>About <?php echo $singleUser->user_name ?></h2>
        <ul>
            <li><label>Name : </label>&nbsp;<?php echo $singleUser->firstname . $singleUser->lastname ?></li>
            <li><label>Phone : </label>&nbsp;<?php echo $singleUser->phone ?></li>
            <li><label>Email : </label>&nbsp;<?php echo $singleUser->email ?></li>
            <li><label>Birth Date : </label>&nbsp;<?php echo date('d-M-y',strtotime($singleUser->dob))?></li>
            <li><label>Phone : </label>&nbsp;<?php echo $singleUser->role ?></li>
        </ul>
    </div>
</div>

</body>


<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/jquery.countdown.js"></script>
<script type="text/javascript">

    $(function(){

        var note = $('#note'),
            ts = new Date("<?= $DATEuPDATE; ?>"),
            newYear = true;

        if((new Date()) > ts){
            // The new year is here! Count towards something else.
            // Notice the *1000 at the end - time must be in milliseconds
            ts = (new Date()).getTime();
            newYear = false;
        }

        $('#countdown').countdown({
            timestamp	: ts,
            callback	: function(days, hours, minutes, seconds){
                var message = "";
                message += days + " day" + ( days==1 ? '':'s' ) + ", ";
                message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
                message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
                message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
                if(newYear){
                    message += "left until 4 Months!";
                }
                else {
                    message += "left to 10 days from now!";
                }
                note.html(message);
            }
        });
    });

    jQuery(function($) {
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);

    })
</script>
</html>