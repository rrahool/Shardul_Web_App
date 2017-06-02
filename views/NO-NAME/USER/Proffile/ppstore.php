<?php
require_once ('../../../../vendor/autoload.php');
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\UserStore;
use App\BloodDonor\Blood_Donor;



if(isset($_FILES['blood_donor_pp']) && !empty($_FILES['blood_donor_pp']['name']))
{
$image_name=$_FILES['blood_donor_pp']['name'];

$temporary_location=$_FILES['blood_donor_pp']['tmp_name'];

move_uploaded_file($temporary_location,'icons/'.$image_name);
$_POST['blood_donor_pp']=$image_name;
}

$objBloodDonorpp=new \App\WareHouse\BloodDonorStore();
$objBloodDonorpp->setdata($_POST);
$objBloodDonorpp->Blood_Donor_pp_upload();