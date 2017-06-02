<?php
if(!isset($_SESSION) )session_start();
require_once ('../../../../vendor/autoload.php');
use APP\Message\Message;
use App\Utility\Utility;
use App\WareHouse\UserStore;
use App\WareHouse\Authentication;
use App\WareHouse\BloodDonorStore;
use App\WareHouse\VolunteerStore;
use App\WareHouse\VolunteerFeesStore;


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

$userID = $singleUser->id;
$role = $singleUser->role;

if($role="Volunteer"){
    $obj= new VolunteerStore();
    $obj->setUserId($userID);
    $volunteerUser = $obj->VolunteerProfileInfo();
}

$VolunteerId=$volunteerUser->id;


$objVolunteerPaymentInfo = new VolunteerFeesStore();
$objVolunteerPaymentInfo->setVolunteerId($VolunteerId);
$paymentinfo = $objVolunteerPaymentInfo->VolunteerPaymentInformation();
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
                    <li><a href="../Proffile/Volunteer_Profile_edit.php" id="logout">Edit Profile</a></li>
                    <li><a href="#" id="monthlyfee"  data-toggle="modal" data-target="#md">Monthly fees</a></li>
                    <li><a href="../Authentication/Logout.php" id="logout"> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="user-image-hold">
            <form role="form" method="post" action="VolPicStore.php" enctype="multipart/form-data">
                <input type="file" name="volunteer_pp" multiple="multiple">
                <input type="hidden" name ="Volunteer_ID" value="<?php echo $VolunteerId;?>">
                <button type="submit" name="upload" class="upload"><i class="ti-camera"></i></button>
            </form>
            <img src="icons/<?php echo $volunteerUser->profile_picture;?>">
        </div>
        </div>
        <br>

        <div class="modal fade" tabindex="-1" role="dialog" id="md">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Payment?</h4>
                    </div>
                    <div class="modal-body">
                        <form action="VolunteerFeesProcess.php" class="editForm" method="post">
                            <input type="hidden" name ="VolunteerID" value="<?php echo $volunteerUser->id?>">
                            <label for="">Ammount paid in BDT</label>
                            <input type="number" name="amount" id="frm" placeholder="amount">
                            <br>
                            <label for="">Payment</label>
                            <input type="date" name="paymentdate" id="frm" placeholder="date">
                            <br>
                            <input type="submit" value="PAY FEES" name="PAY FEE">
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
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

<div class="table-hold">
    <h1 style="color: #fff; text-align: center; margin:0 auto;margin-bottom: 20px ;">Monthly Payment</h1>
    <table style="text-align: center; font-size: 1.2em">
        <tr class="titleHead">
        <th>Payment Date</th>
        <th>Ammount</th>
        <th>Acceptation</th>
        </tr>
        <?php foreach ($paymentinfo as $pay) { ?>
                <tr>
                    <td><?php echo date('d-M-Y',strtotime($pay->Paymentdate)) ?></td>
                    <td><?php echo $pay->ammount ?> BDT</td>
                    <td><?php if($pay->status=='Yes'){echo "ACCEPTED";}else{ echo "PENDING"; } ?></td>
                </tr>
        <?php }?>
    </table>
</div>
</div>

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
</body>
</html>