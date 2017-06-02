<?php
if(!isset($_SESSION) )session_start();
require_once ('../../../../vendor/autoload.php');

use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\UserStore;
use App\WareHouse\Authentication;

if(empty($_POST['UserName']) && empty($_POST['Password'])){
    Message::setMessage
    ("<div style='color:tomato; font-size:.9em; text-transform:Uppercase;'>Fields Can not be Empty</div>");
}elseif (!empty($_POST['UserName']) && empty($_POST['Password'])){
    Message::setMessage
    ("<div style='color:tomato; font-size:.9em; text-transform:Uppercase;'>Password Can not be Empty</div>");
}elseif (empty($_POST['UserName']) && !empty($_POST['Password'])){
    Message::setMessage
    ("<div style='color:tomato; font-size:.9em; text-transform:Uppercase;'>Username Can not be Empty</div>");
}else {
        $auth = new Authentication();
        $status2 = $auth->setData($_POST)->is_registered_username();
        if ($status2) {
            $_SESSION['UserName'] = $_POST['UserName'];
            $obj = new UserStore();
            $obj->setData($_SESSION);
            $singleUser = $obj->view();
            $role = $singleUser->role;
            if ($role == "Volunteer") {
                Message::message("VolUser");
                // Utility::redirect('../Proffile/VolunteerProfile.php');
            }
            if ($role == "BloodDonor") {
                Message::message("DonUser");
                // Utility::redirect('../Proffile/Blood_Donor_Profile.php');
            }

        }else{
        Message::setMessage
        ("<div style='color:tomato; font-size:.9em; text-transform:Uppercase;'>Invalid Information</div>");
    }

}if(!empty($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}