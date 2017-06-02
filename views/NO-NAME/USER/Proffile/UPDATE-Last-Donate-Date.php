<?php
require_once "../../../../vendor/autoload.php";
use App\BloodDonor\Blood_Donor;
use App\WareHouse\BloodDonorStore;
$objUpdateDonateDate=new BloodDonorStore();
$objUpdateDonateDate->setdata($_POST);
$objUpdateDonateDate->Last_Donate_Date_Update();

