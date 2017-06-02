<?php
require_once "../../../vendor/autoload.php";
$objUpdate = new App\WareHouse\VolunteerStore();
$objUpdate->setdata($_REQUEST);
$objUpdate->update();