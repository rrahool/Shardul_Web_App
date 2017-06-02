<?php
require_once "../../../vendor/autoload.php";
$objUpdate = new App\WareHouse\BloodDonorStore();
$objUpdate->setdata($_REQUEST);
$objUpdate->update();