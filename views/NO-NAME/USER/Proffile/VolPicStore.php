<?php
require_once ('../../../../vendor/autoload.php');
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\UserStore;
use App\BloodDonor\Blood_Donor;



if(isset($_FILES['volunteer_pp']) && !empty($_FILES['volunteer_pp']['name']))
{
    $image_name=$_FILES['volunteer_pp']['name'];

    $temporary_location=$_FILES['volunteer_pp']['tmp_name'];

    move_uploaded_file($temporary_location,'icons/'.$image_name);
    $_POST['volunteer_pp']=$image_name;
}

$objBloodDonorpp=new \App\WareHouse\VolunteerStore();
$objBloodDonorpp->setdata($_POST);
$objBloodDonorpp->Volunteer_pp_upload();