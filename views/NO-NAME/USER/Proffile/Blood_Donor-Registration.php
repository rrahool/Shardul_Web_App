<?php
require_once "../../../../vendor/autoload.php";
use App\WareHouse\BloodDonorStore;
$objBloodDonorStore =new BloodDonorStore();
$objBloodDonorStore->setdata($_POST);
$objBloodDonorStore->Blood_Donor_store();
?>